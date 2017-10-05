<?php

class Response
{
    private static function ClientErrorType() {
        return array(
            400 => "HTTP/1.0 400 Bad Request",
            401 => "HTTP/1.0 401 Unauthorized",
            402 => "HTTP/1.0 402",
            403 => "HTTP/1.0 403 Forbidden",
            404 => "HTTP/1.0 404 Not Found",
            405 => "HTTP/1.0 405 Method Not Allowed",
            406 => "HTTP/1.0 406 Not Acceptable"
        );
    }

    private static function ServerErrorType() {
        return array(
            500 => "HTTP/1.0 500 Internal Server Error",
            501 => "HTTP/1.0 501 Not Implemented",
            502 => "HTTP/1.0 502 Bad Gateway",
            503 => "HTTP/1.0 503 Service Unavailable",
            504 => "HTTP/1.0 504 Gateway Timeout",
            505 => "HTTP Version Not Supported"
        );
    }

    private static function ServerOKType() {
        return array(
            200 => "HTTP/1.0 200 OK",
            201 => "HTTP/1.0 201 Created",
            202 => "HTTP/1.0 202 Accepted",
            203 => "HTTP/1.1 203 Non-Authoritative Information",
            204 => "HTTP/1.0 204 No Content",
            205 => "HTTP/1.0 205 Reset Content"
        );
    }

    public static function ServerSuccess( $type, $message = null, $header = null) {
        $responseHeader = self::ServerOKType();
        header($responseHeader[$type]);
        return $message;
    }

    public static function ServerError( $errorType, $message ) {
        $responseHeader = self::ServerErrorType();
        header($responseHeader[$errorType]);
        return $message;
    }

    public static function ClientError( $errorType, $message ) {
        $responseHeader = self::ClientErrorType();
        header($responseHeader[$errorType]);
        return $message;
    }


    public static function typeDatat ($data, $type)
    {
        switch ($type)
        {
        case '.json':
            $data = self::convertJSON($data);
            break;
        case '.xml':
            $data = self::convertXML($data);
            break;
        case '.txt':
            $data = self::convertTXT($data);
            break;
        case '.html':
            $data = self::convertHTML($data);
            break;
        }
        return $data;
    }


    private function  convertJSON($data) {
        header('Content-Type: application/json');
        return json_encode($data);
    }
    private function  convertXML($data) {
        header("Content-Type: text/xml");
        $xml = new SimpleXMLElement('<root/>');
        $data = array_flip($data);
        array_walk_recursive($data, array ($xml, 'addChild'));
        return $xml->asXML(); 
    }
    private function convertTXT($data)
    {
        header('Content-Type: text/javascript; charset=utf-8');
        print_r($data);
    }
    private function convertHTML($data)
    {
        header('Content-Type: text/html; charset=utf-8');
        if(is_array($data))
        {
            print_r('<head>');
            print_r('</head>');
            print_r('<body>');
            print_r('<pre>');
            foreach($data as $key => $value)
            {
                print_r($key . ':' . $value . '<br>');
            } 
            print_r('</pre>');

            return;
        }
        $data = '<pre>' .  $data . '</pre>';
        print_r($data);  
        print_r('</body>');
    }

}
