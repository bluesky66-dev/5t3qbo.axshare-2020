<?php

class CVFileManager {
	private $manageBackendPath;
	private $manageFrontendPath;
	private $saveFileName;

	function __construct( $manageBackendPath = "", $manageFrontendPath = "" ) {
		$this->manageBackendPath  = $manageBackendPath;
		$this->manageFrontendPath = $manageFrontendPath;
		$this->saveFileName       = CV_generateRandom( 16 );
	}

	public function uploadFile( $keyName, $suffix = false ) {

		$resultPath = "";

		$path = CV_MEDIA_DIR . $this->manageBackendPath . "/";

		$valid_formats = array( "jpg", "png", "gif", "bmp", "jpeg", "mp4", "ogv", "webm", "pdf" );

		if ( isset( $_POST ) and $_SERVER['REQUEST_METHOD'] == "POST" ) {

			$name      = $_FILES[ $keyName ]['name'];
			$size      = $_FILES[ $keyName ]['size'];
			$base_name = $suffix ? $this->saveFileName . "_" . $suffix : $this->saveFileName;

			list( $txt, $ext ) = explode( ".", $name );

			if ( in_array( $ext, $valid_formats ) ) {

				$actual_file_name = $base_name . "." . CV_getFileExtension( $name );
				$tmp              = $_FILES[ $keyName ]['tmp_name'];

				if ( ! is_dir( $path ) ) {
					mkdir( $path, 0777, true );
				}

				if ( move_uploaded_file( $tmp, $path . $actual_file_name ) ) {
					$resultPath = $actual_file_name;
				} else {
					$resultPath = "";
				}

			} else {
				$resultPath = "";
			}
		} else {
			$resultPath = "";
		}

		return $resultPath;
	}

	public function uploadMultipleFiles( $keyName ) {
		$resultPath = [];

		$path = CV_MEDIA_DIR . $this->manageBackendPath . "/" . $this->saveFileName . "/";

		$valid_formats = array(
			"jpg",
			"png",
			"gif",
			"bmp",
			"jpeg",
			"mp4",
			"ogv",
			"webm",
			"pdf",
			"html",
			"css",
			"js",
			"xml",
			"json"
		);

		if ( isset( $_POST ) and $_SERVER['REQUEST_METHOD'] == "POST" ) {

			$names = $_FILES[ $keyName ]['name'];
			$sizes = $_FILES[ $keyName ]['size'];

			for ( $i = 0; $i < count( $names ); $i ++ ) {
				if ( strlen( $names[ $i ] ) ) {
					list( $txt, $ext ) = explode( ".", $names[ $i ] );
					if ( in_array( $ext, $valid_formats ) ) {

						$tmp = $_FILES[ $keyName ]['tmp_name'][ $i ];

						$actual_file_name = CV_generateRandom( 16 ) . "." . CV_getFileExtension( $names[ $i ] );

						if ( ! is_dir( $path ) ) {
							mkdir( $path, 0777, true );
						}

						if ( move_uploaded_file( $tmp, $path . $actual_file_name ) ) {

							$resultPath[] = $this->saveFileName . "/" . $actual_file_name;

						} else {
							$resultPath = [];
						}
					} else {
						$resultPath = [];
					}
				} else {
					$resultPath = [];
				}
			}

		} else {
			$resultPath = [];
		}

		return $resultPath;
	}

	public function getFilePath( $fileName = "" ) {
		return $fileName ? $fileName : CV_FRONTEND . "img/noPhoto.png";
	}

	public function getFrontendFilePath( $fileName ) {
		return $fileName ? CV_FRONTEND . $this->manageFrontendPath . "/" . $fileName : "";
	}

	static public function getBackendFilePathFromFileName( $fileName ) {
		return $fileName ? CV_BACKEND . $fileName : CV_BACKEND . "img/noPhoto.png";
	}

	public function deleteBackendFile( $file ) {
		$fiePath = CV_MEDIA_DIR. $this->manageBackendPath . "/" . $file;
		if ( is_file( $fiePath ) ) {
			unlink( $fiePath );

			return true;
		} else {
			return false;
		}
	}

	static public function smart_resize_image(
		$file,
		$string = null,
		$width = 0,
		$height = 0,
		$proportional = false,
		$output = 'file',
		$delete_original = true,
		$use_linux_commands = false,
		$quality = 100,
		$grayscale = false
	) {

		if ( $height <= 0 && $width <= 0 ) {
			return false;
		}
		if ( $file === null && $string === null ) {
			return false;
		}

		# Setting defaults and meta
		$info         = $file !== null ? getimagesize( $file ) : getimagesizefromstring( $string );
		$image        = '';
		$final_width  = 0;
		$final_height = 0;
		list( $width_old, $height_old ) = $info;
		$cropHeight = $cropWidth = 0;

		# Calculating proportionality
		if ( $proportional ) {
			if ( $width == 0 ) {
				$factor = $height / $height_old;
			} elseif ( $height == 0 ) {
				$factor = $width / $width_old;
			} else {
				$factor = min( $width / $width_old, $height / $height_old );
			}

			$final_width  = round( $width_old * $factor );
			$final_height = round( $height_old * $factor );
		} else {
			$final_width  = ( $width <= 0 ) ? $width_old : $width;
			$final_height = ( $height <= 0 ) ? $height_old : $height;
			$widthX       = $width_old / $width;
			$heightX      = $height_old / $height;

			$x          = min( $widthX, $heightX );
			$cropWidth  = ( $width_old - $width * $x ) / 2;
			$cropHeight = ( $height_old - $height * $x ) / 2;
		}

		# Loading image to memory according to type
		switch ( $info[2] ) {
			case IMAGETYPE_JPEG:
				$file !== null ? $image = imagecreatefromjpeg( $file ) : $image = imagecreatefromstring( $string );
				break;
			case IMAGETYPE_GIF:
				$file !== null ? $image = imagecreatefromgif( $file ) : $image = imagecreatefromstring( $string );
				break;
			case IMAGETYPE_PNG:
				$file !== null ? $image = imagecreatefrompng( $file ) : $image = imagecreatefromstring( $string );
				break;
			default:
				return false;
		}

		# Making the image grayscale, if needed
		if ( $grayscale ) {
			imagefilter( $image, IMG_FILTER_GRAYSCALE );
		}

		# This is the resizing/resampling/transparency-preserving magic
		$image_resized = imagecreatetruecolor( $final_width, $final_height );
		if ( ( $info[2] == IMAGETYPE_GIF ) || ( $info[2] == IMAGETYPE_PNG ) ) {
			$transparency = imagecolortransparent( $image );
			$palletsize   = imagecolorstotal( $image );

			if ( $transparency >= 0 && $transparency < $palletsize ) {
				$transparent_color = imagecolorsforindex( $image, $transparency );
				$transparency      = imagecolorallocate( $image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue'] );
				imagefill( $image_resized, 0, 0, $transparency );
				imagecolortransparent( $image_resized, $transparency );
			} elseif ( $info[2] == IMAGETYPE_PNG ) {
				imagealphablending( $image_resized, false );
				$color = imagecolorallocatealpha( $image_resized, 0, 0, 0, 127 );
				imagefill( $image_resized, 0, 0, $color );
				imagesavealpha( $image_resized, true );
			}
		}
		imagecopyresampled( $image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight );


		# Taking care of original, if needed
		if ( $delete_original ) {
			if ( $use_linux_commands ) {
				exec( 'rm ' . $file );
			} else {
				@unlink( $file );
			}
		}

		# Preparing a method of providing result
		switch ( strtolower( $output ) ) {
			case 'browser':
				$mime = image_type_to_mime_type( $info[2] );
				header( "Content-type: $mime" );
				$output = null;
				break;
			case 'file':
				$output = $file;
				break;
			case 'return':
				return $image_resized;
				break;
			default:
				break;
		}

		# Writing image according to type to the output destination and image quality

		switch ( $info[2] ) {
			case IMAGETYPE_GIF:
				imagegif( $image_resized, $output );
				break;
			case IMAGETYPE_JPEG:
				imagejpeg( $image_resized, $output, $quality );
				break;
			case IMAGETYPE_PNG:
				$quality = 9 - (int) ( ( 0.9 * $quality ) / 10.0 );
				imagepng( $image_resized, $output, $quality );
				break;
			default:
				return false;
		}

		return true;
	}


	static public function deleteDirectory( $dirname ) {
		if ( is_dir( $dirname ) ) {
			$dir_handle = opendir( $dirname );
		}
		if ( ! $dir_handle ) {
			return false;
		}
		while ( $file = readdir( $dir_handle ) ) {
			if ( $file != "." && $file != ".." ) {
				if ( ! is_dir( $dirname . "/" . $file ) ) {
					unlink( $dirname . "/" . $file );
				} else {
					CVFileManager::deleteDirectory( $dirname . '/' . $file );
				}
			}
		}
		closedir( $dir_handle );
		rmdir( $dirname );

		return true;
	}

	static public function getDirContents( $dir ) {
		$rii = new RecursiveIteratorIterator( new RecursiveDirectoryIterator( $dir ) );

		$files = array();
		foreach ( $rii as $file ) {
			if ( ! $file->isDir() ) {
				$files[] = $file->getPathname();
			}
		}

		return $files;
	}

	static public function delecteFile( $fiePath ) {
		if ( is_file( $fiePath ) ) {
			unlink( $fiePath );

			return true;
		} else {
			return false;
		}
	}
}