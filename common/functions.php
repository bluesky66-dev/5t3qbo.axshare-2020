<?php

function logToFile( $filename, $msg ) {
	$fd  = fopen( $filename, "a" );
	$str = "[" . date( "Y/m/d h:i:s", time() ) . "] " . $msg;
	fwrite( $fd, $str . "\n" );
	fclose( $fd );
}

function CV_MkDir( $path, $mode = 0777 ) {
	$dirs  = explode( DIRECTORY_SEPARATOR, $path );
	$count = count( $dirs );
	$path  = '.';
	for ( $i = 0; $i < $count; ++ $i ) {
		$path .= DIRECTORY_SEPARATOR . $dirs[ $i ];
		if ( ! is_dir( $path ) && ! mkdir( $path, $mode ) ) {
			return false;
		}
	}

	return true;
}

function CV_generateRandom( $len ) {
	$strpattern = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
	$result     = "";
	for ( $i = 0; $i < $len; $i ++ ) {
		$rand   = rand( 0, strlen( $strpattern ) - 1 );
		$result = $result . $strpattern[ $rand ];
	}

	return $result;
}

function CV_isLogin() {
	if ( isset( $_SESSION['CV_TOKEN'] ) ) {
		return true;
	} else {
		return false;
	}
}

function CV_isAdmin() {
	global $user;
	if ( ! isset( $user ) ) {
		return false;
	}
	if ( $user["usType"] == 1 ) {
		return true;
	} else {
		return false;
	}
}

function CV_setCookie( $name, $value ) {
	setcookie( $name, $value . "", time() + ( 2 * 7 * 24 * 60 * 60 ) );
}

function CV_getCookie( $name ) {
	return isset( $_COOKIE[ $name ] ) ? $_COOKIE[ $name ] : "";
}

function CV_deleteCookie( $name ) {
	setcookie( $name, "", time() - 3600 );
}

function CV_setSession( $name, $value ) {
	$_SESSION[ $name ] = $value;
}

function CV_getSession( $name ) {
	return isset( $_SESSION[ $name ] ) ? $_SESSION[ $name ] : "";
}

function CV_deleteSession( $name ) {
	unset( $_SESSION[ $name ] );
}

function CV_setLogin( $token ) {
	CV_setSession( "CV_TOKEN", $token );
	CV_setCookie( "CV_TOKEN", $token );
}

function CV_logout() {
	CV_deleteSession( "CV_TOKEN" );
	CV_deleteCookie( "CV_TOKEN" );
}

function CV_getCurrentId() {
	if ( CV_isLogin() ) {
		return CV_getUserId( $_SESSION['CV_TOKEN'] );
	} else {
		return "";
	}
}

function CV_getUserId( $token ) {
	global $user;

	if ( $token == "" ) {
		return "";
	} else {
		if ( $user ) {
			return $user['usId'];
		} else {
			return "";
		}
	}
}

function CV_getCurrentUser() {
	if ( CV_isLogin() ) {
		return CV_getUser( $_SESSION['CV_TOKEN'] );
	} else {
		return "";
	}
}

function CV_getUser( $token ) {
	$user = CVUser::getUserByToken( $token );
	return $user;
}

function CV_getCurrentType() {
	if ( CV_isLogin() ) {
		return CV_getUserType( $_SESSION['CV_TOKEN'] );
	} else {
		return "";
	}
}

function CV_getUserType( $token ) {
	global $user;

	if ( $token == "" ) {
		return "";
	} else {
		if ( $user ) {
			return $user['usType'];
		} else {
			return "";
		}
	}
}

function CV_getPaginationQuery( $page, $rows ) {

	$offset = ( $page - 1 ) * $rows;

	return " LIMIT $offset, $rows";
}

function CV_realEscapeArray( $data ) {
	global $db;

	$result = [];

	if ( ! is_array( $data ) ) {
		return $db->RES( $data );
	}

	$keys = array_keys( $data );

	foreach ( $keys as $key ) {
		if ( is_array( $data[ $key ] ) ) {
			$result[ $key ] = CV_realEscapeArray( $data[ $key ] );
		} else {
			$result[ $key ] = $db->RES( $data[ $key ] );
		}
	}

	return $result;
}

function CV_trimArray( $data ) {

	$result = [];

	if ( ! is_array( $data ) ) {
		return trim( $data );
	}

	$keys = array_keys( $data );
	foreach ( $keys as $key ) {
		if ( is_array( $data[ $key ] ) ) {
			$result[ $key ] = CV_trimArray( $data[ $key ] );
		} else {
			$result[ $key ] = trim( $data[ $key ] );
		}
	}

	return $result;
}

function CV_getFileExtension( $file ) {
	$extension = end( explode( ".", $file ) );

	return $extension ? $extension : false;
}

function CV_escapeString( $CV_str ) {

	$pt_rstr = strtolower( $CV_str );
	$pt_rstr = trim( $pt_rstr );
	$pt_rstr = str_replace( ' ', '-', $pt_rstr );

	return $pt_rstr;
}

function CV_getExcerptString( $CV_str, $length = 50 ) {
	$result = "";
	if ( mb_strlen( $CV_str ) > $length ) {
		$subex   = mb_substr( $CV_str, 0, $length - 5 );
		$exwords = explode( ' ', $subex );
		$excut   = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			$result .= mb_substr( $subex, 0, $excut );
		} else {
			$result .= $subex;
		}
		$result .= ' [...]';
	} else {
		$result .= $CV_str;
	}

	return $result;
}

function CV_realFilePath( $path, $file ) {
	$realPath = CV_BACKEND . "img/noPhoto.png";
	if ( $file && $path ) {
		if ( is_file( CV_MEDIA_DIR . $path . "/" . $file ) ) {
			$realPath = CV_MEDIA_PATH . $path . "/" . $file;
		}
	}

	return $realPath;
}

function CV_getRequest( $url ) {
    $result = array();
    $result['code'] = 200;
    $ch=curl_init();
    $timeout=5;

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

    $response=curl_exec($ch);
    if (curl_error($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        $result['code'] = 0;
        $result['error'] = $error_msg;
        return $result;
    }
    curl_close($ch);
    $result['body'] = $response;
    return $result;
}

function CV_getETSYStore( $url ) {
    $result = array();
    $result['code'] = 200;
    $ch=curl_init();
    $timeout=50;

    $agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36";
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_VERBOSE, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $response=curl_exec($ch);
    if (curl_error($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        $result['code'] = 0;
        $result['error'] = $error_msg;
        return "";
    }
    curl_close($ch);
    $result['body'] = $response;
    return $response;
}

function CV_array_to_csv($data, $filename, $attachment = false, $headers = true) {

	if($attachment) {
		// send response headers to the browser
		header( 'Content-Type: text/csv' );
		header( 'Content-Disposition: attachment;filename='.$filename);
		$fp = fopen('php://output', 'w');
	} else {
		$fp = fopen($filename, 'w');
	}

	if($headers) {
		if($data[0]) {
			fputcsv($fp, array_keys($data[0]));
		}
	}

	foreach($data AS $row) {
		fputcsv($fp, $row);
	}

	fclose($fp);
}

?>