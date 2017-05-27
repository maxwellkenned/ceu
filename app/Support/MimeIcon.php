<?php

namespace ceu\Support;

class MimeIcon
{

  public function __construct(){

  }


  public function font_icon( $mime_type ) {
    // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
    static $font_awesome_file_icon_classes = array(
      // Images
      'image' => 'fa-file-image-o',
      // Audio
      'audio' => 'fa-file-audio-o',
      // Video
      'video' => 'fa-file-video-o',
      // Documents
      'application/pdf' => 'fa-file-pdf-o',
      'text/plain' => 'fa-file-text-o',
      'text/html' => 'fa-file-code-o',
      'application/json' => 'fa-file-code-o',
      // Archives
      'application/gzip' => 'fa-file-archive-o',
      'application/zip' => 'fa-file-archive-o',
      'application/x-zip-compressed' => 'fa-file-archive-o',
      // Misc
      'application/octet-stream' => 'fa-file-archive-o',
      //Folder
      'folder' => 'fa-folder',
    );
    if (isset($font_awesome_file_icon_classes[ $mime_type ])) {
      return $font_awesome_file_icon_classes[ $mime_type ];
    }
    $mime_parts = explode('/', $mime_type, 2);
    $mime_group = $mime_parts[0];
    if (isset($font_awesome_file_icon_classes[ $mime_group ])) {
      return $font_awesome_file_icon_classes[ $mime_group ];
    }
    return "fa-file";
  }
}