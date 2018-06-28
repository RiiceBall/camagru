<?php
    function resize($file, $size, $temp) {
        $uploadDir = '../picture/';
        if ($size["mime"] == "image/png" || $size["mime"] == "image/jpeg") {
            if (!($image = ($size["mime"] == "image/jpeg") ?
            imagecreatefromjpeg($file) : imagecreatefrompng($file))) {
                echo "1";
                exit(0);
            }
            imagealphablending($image, false);
            imagesavealpha($image, true);
            $new_image = imagecreatetruecolor(400, 300);
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            $trans = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagefill($new_image, 0, 0, $trans);
            imagecopyresampled($new_image, $image, 0, 0, 0, 0, 400, 300, $size[0], $size[1]);
            if (!(file_put_contents($uploadDir . $temp, " "))) {
                echo "1";
                exit(0);
            }
            imagepng($new_image, $uploadDir . $temp);
            imagedestroy($image);
            imagedestroy($new_image);
            return (imagecreatefrompng($uploadDir . $temp));
        }
        return "";
    }

    function get_dest($file) {
        $uploadDir = '../picture/';
        $dest = $file;
        if (strstr($dest, "base64")) {
            $destData = $dest;
            $destData = str_replace('data:image/png;base64,', '', $destData);
            $destData = str_replace(' ', '+', $destData);
            $destination = base64_decode($destData);
            if (!(file_put_contents($uploadDir . "temp_img", $destination))) {
                echo "1";
                exit(0);
            }
            $dest = $uploadDir . "temp_img";
        }
        return ($dest);
    }

    function del_temp_file() {
        $uploadDir = '../picture/';
        if (file_exists($uploadDir . "temp_img"))
            unlink($uploadDir . "temp_img");
        if (file_exists($uploadDir . "temp_dest"))
            unlink($uploadDir . "temp_dest");
        if (file_exists($uploadDir . "temp_source"))
            unlink($uploadDir . "temp_source");
    }
