<?php
//////////////////////////////////////////////////////////////
///  phpThumb() by James Heinrich <info@silisoftware.com>   //
//        available at http://phpthumb.sourceforge.net     ///
//////////////////////////////////////////////////////////////
///                                                         //
// See: phpthumb.readme.txt for usage instructions          //
//                                                         ///
//////////////////////////////////////////////////////////////

ob_start();
if (!include_once(dirname(__FILE__).'/phpthumb.functions.php')) {
	ob_end_flush();
	die('failed to include_once("'.realpath(dirname(__FILE__).'/phpthumb.functions.php').'")');
}
ob_end_clean();

class phpthumb {

	// public:
	// START PARAMETERS (for object mode and phpThumb.php)
	// See phpthumb.readme.txt for descriptions of what each of these values are
	var $src  = null;    // SouRCe filename
	var $new  = null;    // NEW image (phpThumb.php only)
	var $w    = null;    // Width
	var $h    = null;    // Height
	var $wp   = null;    // Width  (Portrait Images Only)
	var $hp   = null;    // Height (Portrait Images Only)
	var $wl   = null;    // Width  (Landscape Images Only)
	var $hl   = null;    // Height (Landscape Images Only)
	var $ws   = null;    // Width  (Square Images Only)
	var $hs   = null;    // Height (Square Images Only)
	var $f    = null;    // Format
	var $q    = 75;      // jpeg output Quality
	var $sx   = null;    // Source crop top-left X position
	var $sy   = null;    // Source crop top-left Y position
	var $sw   = null;    // Source crop Width
	var $sh   = null;    // Source crop Height
	var $zc   = null;    // Zoom Crop
	var $bc   = null;    // Border Color
	var $bg   = null;    // BackGround color
	var $fltr = array(); // FiLTeRs
	var $goto = null;    // GO TO url after processing
	var $err  = null;    // default ERRor image filename
	var $xto  = null;    // extract eXif Thumbnail Only
	var $ra   = null;    // Rotate by Angle
	var $ar   = null;    // Auto Rotate
	var $aoe  = null;    // Allow Output Enlargement
	var $far  = null;    // Fixed Aspect Ratio
	var $iar  = null;    // Ignore Aspect Ratio
	var $maxb = null;    // MAXimum Bytes
	var $down = null;    // DOWNload thumbnail filename
	var $md5s = null;    // MD5 hash of Source image
	var $file = null;    // >>deprecated, do not use<<

	var $phpThumbDebug = null;
	// END PARAMETERS


	// public:
	// START CONFIGURATION OPTIONS (for object mode only)
	// See phpThumb.config.php for descriptions of what each of these settings do

	// * Directory Configuration
	var $config_cache_directory                      = null;
	var $config_cache_disable_warning                = true;
	var $config_cache_source_enabled                 = false;
	var $config_cache_source_directory               = null;
	var $config_temp_directory                       = null;
	var $config_document_root                        = null;

	// * Default output configuration:
	var $config_output_format                        = 'jpeg';
	var $config_output_maxwidth                      = 0;
	var $config_output_maxheight                     = 0;
	var $config_output_interlace                     = true;

	// * Error message configuration
	var $config_error_image_width                    = 400;
	var $config_error_image_height                   = 100;
	var $config_error_message_image_default          = '';
	var $config_error_bgcolor                        = 'CCCCFF';
	var $config_error_textcolor                      = 'FF0000';
	var $config_error_fontsize                       = 1;
	var $config_error_die_on_error                   = true;
	var $config_error_silent_die_on_error            = false;
	var $config_error_die_on_source_failure          = true;

	// * Anti-Hotlink Configuration:
	var $config_nohotlink_enabled                    = true;
	var $config_nohotlink_valid_domains              = array();
	var $config_nohotlink_erase_image                = true;
	var $config_nohotlink_text_message               = 'Off-server thumbnailing is not allowed';
	// * Off-server Linking Configuration:
	var $config_nooffsitelink_enabled                = false;
	var $config_nooffsitelink_valid_domains          = array();
	var $config_nooffsitelink_require_refer          = false;
	var $config_nooffsitelink_erase_image            = true;
	var $config_nooffsitelink_text_message           = 'Off-server linking is not allowed';
	var $config_cache_differentiate_offsite          = true;

	// * Border & Background default colors
	var $config_border_hexcolor                      = '000000';
	var $config_background_hexcolor                  = 'FFFFFF';

	// * TrueType Fonts
	var $config_ttf_directory                        = '.';

	var $config_max_source_pixels                    = null;
	var $config_use_exif_thumbnail_for_speed         = false;

	var $config_imagemagick_path                     = null;
	var $config_prefer_imagemagick                   = true;

	var $config_cache_maxage                         = null;
	var $config_cache_maxsize                        = null;
	var $config_cache_maxfiles                       = null;

	var $config_cache_source_filemtime_ignore_local  = false;
	var $config_cache_source_filemtime_ignore_remote = false;

	var $config_cache_default_only_suffix            = false;

	// * MySQL
	var $config_mysql_query                          = null;
	var $config_mysql_hostname                       = null;
	var $config_mysql_username                       = null;
	var $config_mysql_password                       = null;
	var $config_mysql_database                       = null;

	// * Security
	var $config_high_security_enabled                = false;
	var $config_config_high_security_password        = null;

	var $config_disable_debug                        = false;
	var $config_allow_src_above_docroot              = true;
	var $config_allow_src_above_phpthumb             = true;
	var $config_allow_parameter_file                 = false;
	var $config_allow_parameter_goto                 = false;

	// END CONFIGURATION OPTIONS

	// public: error messages (read-only)
	var $debugmessages = array();
	var $debugtiming   = array();
	var $fatalerror    = null;

	// private: (should not be modified directly)
	var $thumbnailQuality = 75;
	var $thumbnailFormat  = null;

	var $sourceFilename   = null;
	var $rawImageData     = null;
	var $IMresizedData    = null;

	var $gdimg_output     = null;
	var $gdimg_source     = null;

	var $getimagesizeinfo = null;

	var $source_width  = null;
	var $source_height = null;

	var $thumbnailCropX = null;
	var $thumbnailCropY = null;
	var $thumbnailCropW = null;
	var $thumbnailCropH = null;

	var $exif_thumbnail_width  = null;
	var $exif_thumbnail_height = null;
	var $exif_thumbnail_type   = null;
	var $exif_thumbnail_data   = null;

	var $thumbnail_width        = null;
	var $thumbnail_height       = null;
	var $thumbnail_image_width  = null;
	var $thumbnail_image_height = null;

	var $cache_filename         = null;

	var $is_alpha = false;

	var $iswindows = null;
	var $osslash   = null;

	var $phpthumb_version = '1.6.2-200511240855';

	//////////////////////////////////////////////////////////////////////

	// public: constructor
	function phpThumb() {
		$this->DebugTimingMessage('phpThumb() constructor', __FILE__, __LINE__);
		$this->config_max_source_pixels = round(max(intval(ini_get('memory_limit')), intval(get_cfg_var('memory_limit'))) * 1048576 * 0.20); // 20% of memory_limit

		if (phpthumb_functions::gd_version() < 1) {
			die('No GD support detected');
		}
		if (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
			$this->iswindows = true;
			$this->osslash   = '\\';
		} else {
			$this->iswindows = false;
			$this->osslash   = '/';
		}
		if (@$_SERVER['DOCUMENT_ROOT']) {
			$this->config_document_root = $_SERVER['DOCUMENT_ROOT'];
		}
	}

	// public:
	function setSourceFilename($sourceFilename) {
		$this->rawImageData   = null;
		$this->sourceFilename = $sourceFilename;
		$this->DebugMessage('setSourceFilename('.$sourceFilename.') set $this->sourceFilename to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		return true;
	}

	// public:
	function setSourceData($rawImageData, $sourceFilename='') {
		$this->sourceFilename = null;
		$this->rawImageData   = $rawImageData;
		if ($this->config_cache_source_enabled) {
			$sourceFilename = ($sourceFilename ? $sourceFilename : md5($rawImageData));
			if (!is_dir($this->config_cache_source_directory) && !$this->phpThumbDebug) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not a directory');
			} elseif (!is_writable($this->config_cache_source_directory) && !$this->phpThumbDebug) {
				$this->ErrorImage('$this->config_cache_source_directory ('.$this->config_cache_source_directory.') is not writable');
			}
			$this->DebugMessage('setSourceData() attempting to save source image to "'.$this->config_cache_source_directory.$this->osslash.urlencode($sourceFilename).'"', __FILE__, __LINE__);
			if ($fp = @fopen($this->config_cache_source_directory.$this->osslash.urlencode($sourceFilename), 'wb')) {
				fwrite($fp, $rawImageData);
				fclose($fp);
			} elseif (!$this->phpThumbDebug) {
				$this->ErrorImage('setSourceData() failed to write to source cache ('.$this->config_cache_source_directory.$this->osslash.urlencode($sourceFilename).')');
			}
		}
		return true;
	}

	// public:
	function setSourceImageResource($gdimg) {
		$this->gdimg_source = $gdimg;
		return true;
	}

	// public:
	function setParameter($param, $value) {
		switch ($param) {
			case 'src':
				$this->setSourceFilename($this->ResolveFilenameToAbsolute($value));
				break;

			default:
				$this->$param = $value;
				break;
		}
		$this->$param = $value;
		return true;
	}

	// public:
	function getParameter($param) {
		//if (property_exists('phpThumb', $param)) {
			return $this->$param;
		//}
		//$this->DebugMessage('setParameter() attempting to set non-existant parameter "'.$param.'"', __FILE__, __LINE__);
		//return false;
	}

	// public:
	function GenerateThumbnail() {

		$this->setOutputFormat();
		$this->ResolveSource();
		$this->SetCacheFilename();
		$this->ExtractEXIFgetImageSize();
		if (!$this->SourceImageToGD()) {
			return false;
		}
		$this->Rotate();
		$this->CreateGDoutput();

		switch ($this->far) {
			case 'L':
			case 'TL':
			case 'BL':
				$destination_offset_x = 0;
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'R':
			case 'TR':
			case 'BR':
				$destination_offset_x =  round($this->thumbnail_width  - $this->thumbnail_image_width);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
				break;
			case 'T':
			case 'TL':
			case 'TR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = 0;
				break;
			case 'B':
			case 'BL':
			case 'BR':
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y =  round($this->thumbnail_height - $this->thumbnail_image_height);
				break;
			case 'C':
			default:
				$destination_offset_x = round(($this->thumbnail_width  - $this->thumbnail_image_width)  / 2);
				$destination_offset_y = round(($this->thumbnail_height - $this->thumbnail_image_height) / 2);
		}

		// copy/resize image to appropriate dimensions
		phpthumb_functions::ImageResizeFunction(
			$this->gdimg_output,
			$this->gdimg_source,
			$destination_offset_x,
			$destination_offset_y,
			$this->thumbnailCropX,
			$this->thumbnailCropY,
			$this->thumbnail_image_width,
			$this->thumbnail_image_height,
			$this->thumbnailCropW,
			$this->thumbnailCropH
		);

		$this->AntiOffsiteLinking();
		$this->ApplyFilters();
		$this->AlphaChannelFlatten();
		$this->MaxFileSize();

		$this->DebugMessage('GenerateThumbnail() completed successfully', __FILE__, __LINE__);
		return true;
	}

	// public:
	function RenderToFile($filename) {
		if (!is_resource($this->gdimg_output)) {
			$this->DebugMessage('RenderToFile('.$filename.') failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (!$this->thumbnailFormat) {
			$this->DebugMessage('RenderToFile() failed because $this->thumbnailFormat is empty', __FILE__, __LINE__);
			return false;
		}
		// render thumbnail to this file only, do not cache, do not output to browser
		//$renderfilename = $this->ResolveFilenameToAbsolute(dirname($filename)).$this->osslash.basename($filename);
		$renderfilename = $filename;
		if (($filename{0} != '/') && ($filename{0} != '\\') && ($filename{1} != ':')) {
			$renderfilename = $this->ResolveFilenameToAbsolute($renderfilename);
		}
		$this->DebugMessage('RenderToFile('.$filename.') attempting Image'.strtoupper(@$this->thumbnailFormat).'($this->gdimg_output, '.$renderfilename.')', __FILE__, __LINE__);
		if (!is_writable(dirname($renderfilename))) {
			$this->DebugMessage(dirname($renderfilename).'/ is not writable', __FILE__, __LINE__);
		}
		if (is_file($renderfilename) && !is_writable($renderfilename)) {
			$this->DebugMessage($renderfilename.' is not writable', __FILE__, __LINE__);
		}

		$useRawIMoutput = true;
		if (!$this->IMresizedData || (@$this->getimagesizeinfo[2] != 1) || ($this->thumbnailFormat != 'gif')) {
			$this->DebugMessage('RenderToFile skipping $useRawIMoutput because of $this->getimagesizeinfo[2] ('.@$this->getimagesizeinfo[2].') or $this->thumbnailFormat ('.$this->thumbnailFormat.')', __FILE__, __LINE__);
			$useRawIMoutput = false;
		} else {
			$UnAllowedParameters = array('sx', 'sy', 'sw', 'sh', 'xto', 'ra', 'ar', 'bg', 'bc', 'fltr');
			foreach ($UnAllowedParameters as $parameter) {
				if ($this->$parameter) {
					$useRawIMoutput = false;
					break;
				}
			}
		}

		if ($useRawIMoutput) {

			$this->DebugMessage('RenderToFile copying $this->IMresizedData ('.strlen($this->IMresizedData).' bytes) to "'.$renderfilename.'"', __FILE__, __LINE__);
			return file_put_contents($renderfilename, $this->IMresizedData);

		} else {

			ob_start();
			switch ($this->thumbnailFormat) {
				case 'jpeg':
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					$ImageOutFunction($this->gdimg_output, $renderfilename, $this->thumbnailQuality);
					break;

				case 'png':
				case 'gif':
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					$ImageOutFunction($this->gdimg_output, $renderfilename);
					break;

				default:
					$this->DebugMessage('RenderToFile failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
					return false;
			}
			$errormessage = strip_tags(ob_get_contents());
			ob_end_clean();
			if ($errormessage) {
				$this->DebugMessage('RenderToFile ['.$ImageOutFunction.'('.$renderfilename.')] failed with message "'.$errormessage.'"', __FILE__, __LINE__);
				return false;
			} elseif (!file_exists($renderfilename)) {
				$this->DebugMessage('RenderToFile ['.$ImageOutFunction.'('.$renderfilename.')] did not appear to fail, but the output image does not exist either...', __FILE__, __LINE__);
			}

		}
		return true;
	}

	// public:
	function OutputThumbnail() {
		if (!is_resource($this->gdimg_output)) {
			$this->DebugMessage('OutputThumbnail() failed because !is_resource($this->gdimg_output)', __FILE__, __LINE__);
			return false;
		}
		if (headers_sent()) {
			return $this->ErrorImage('OutputThumbnail() failed - headers already sent');
			exit;
		}

		if ($this->down) {
			$downloadfilename = ereg_replace('[/\\:\*\?"<>|]', '_', $this->down);
			if (phpthumb_functions::version_compare_replacement(phpversion(), '4.1.0', '>=')) {
				$downloadfilename = trim($downloadfilename, '.');
			}
			if ($downloadfilename != $this->down) {
				$this->DebugMessage('renaming output file for "down" from "'.$this->down.'" to "'.$downloadfilename.'"', __FILE__, __LINE__);
			}
			if ($downloadfilename) {
				header('Content-Disposition: attachment; filename="'.$downloadfilename.'"');
			} else {
				$this->DebugMessage('failed to send Content-Disposition header because $downloadfilename is empty', __FILE__, __LINE__);
			}
		}

		$useRawIMoutput = true;
		if ((@$this->getimagesizeinfo[2] != 1) || ($this->thumbnailFormat != 'gif')) {
			$this->DebugMessage('RenderToFile skipping $useRawIMoutput because of $this->getimagesizeinfo[2] ('.@$this->getimagesizeinfo[2].') or $this->thumbnailFormat ('.$this->thumbnailFormat.')', __FILE__, __LINE__);
			$useRawIMoutput = false;
		} else {
			$UnAllowedParameters = array('sx', 'sy', 'sw', 'sh', 'xto', 'ra', 'ar', 'bg', 'bc', 'fltr');
			foreach ($UnAllowedParameters as $parameter) {
				if ($this->$parameter) {
					$useRawIMoutput = false;
					break;
				}
			}
		}

		if ($useRawIMoutput) {

			header('Content-Type: image/'.$this->thumbnailFormat);
			echo $this->IMresizedData;

		} else {

			ImageInterlace($this->gdimg_output, intval($this->config_output_interlace));
			switch ($this->thumbnailFormat) {
				case 'jpeg':
					header('Content-Type: image/'.$this->thumbnailFormat);
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output, '', $this->thumbnailQuality);
					break;

				case 'png':
				case 'gif':
					header('Content-Type: image/'.$this->thumbnailFormat);
					$ImageOutFunction = 'image'.$this->thumbnailFormat;
					@$ImageOutFunction($this->gdimg_output);
					break;

				default:
					$this->DebugMessage('OutputThumbnail failed because $this->thumbnailFormat "'.$this->thumbnailFormat.'" is not valid', __FILE__, __LINE__);
					return false;
					break;
			}
			ImageDestroy($this->gdimg_output);

		}
		return true;
	}

	// public:
	function CleanUpCacheDirectory() {
		if (($this->config_cache_maxage > 0) || ($this->config_cache_maxsize > 0) || ($this->config_cache_maxfiles > 0)) {
			$CacheDirOldFilesAge  = array();
			$CacheDirOldFilesSize = array();
			if ($dirhandle = opendir($this->config_cache_directory)) {
				while ($oldcachefile = readdir($dirhandle)) {
					if (eregi('^phpThumb_cache_', $oldcachefile)) {
						$CacheDirOldFilesAge[$oldcachefile] = fileatime($this->config_cache_directory.$this->osslash.$oldcachefile);
						if ($CacheDirOldFilesAge[$oldcachefile] == 0) {
							$CacheDirOldFilesAge[$oldcachefile] = filemtime($this->config_cache_directory.$this->osslash.$oldcachefile);
						}

						$CacheDirOldFilesSize[$oldcachefile] = filesize($this->config_cache_directory.$this->osslash.$oldcachefile);
					}
				}
			}
			asort($CacheDirOldFilesAge);

			if ($this->config_cache_maxfiles > 0) {
				$TotalCachedFiles = count($CacheDirOldFilesAge);
				$DeletedKeys = array();
				foreach ($CacheDirOldFilesAge as $oldcachefile => $filedate) {
					if ($TotalCachedFiles > $this->config_cache_maxfiles) {
						$TotalCachedFiles--;
						if (@unlink($this->config_cache_directory.$this->osslash.$oldcachefile)) {
							$DeletedKeys[] = $oldcachefile;
						}
					} else {
						// there are few enough files to keep the rest
						break;
					}
				}
				foreach ($DeletedKeys as $oldcachefile) {
					unset($CacheDirOldFilesAge[$oldcachefile]);
					unset($CacheDirOldFilesSize[$oldcachefile]);
				}
			}

			if ($this->config_cache_maxage > 0) {
				$mindate = time() - $this->config_cache_maxage;
				$DeletedKeys = array();
				foreach ($CacheDirOldFilesAge as $oldcachefile => $filedate) {
					if ($filedate > 0) {
						if ($filedate < $mindate) {
							if (@unlink($this->config_cache_directory.$this->osslash.$oldcachefile)) {
								$DeletedKeys[] = $oldcachefile;
							}
						} else {
							// the rest of the files are new enough to keep
							break;
						}
					}
				}
				foreach ($DeletedKeys as $oldcachefile) {
					unset($CacheDirOldFilesAge[$oldcachefile]);
					unset($CacheDirOldFilesSize[$oldcachefile]);
				}
			}

			if ($this->config_cache_maxsize > 0) {
				$TotalCachedFileSize = array_sum($CacheDirOldFilesSize);
				$DeletedKeys = array();
				foreach ($CacheDirOldFilesAge as $oldcachefile => $filedate) {
					if ($TotalCachedFileSize > $this->config_cache_maxsize) {
						$TotalCachedFileSize -= $CacheDirOldFilesSize[$oldcachefile];
						if (@unlink($this->config_cache_directory.$this->osslash.$oldcachefile)) {
							$DeletedKeys[] = $oldcachefile;
						}
					} else {
						// the total filesizes are small enough to keep the rest of the files
						break;
					}
				}
				foreach ($DeletedKeys as $oldcachefile) {
					unset($CacheDirOldFilesAge[$oldcachefile]);
					unset($CacheDirOldFilesSize[$oldcachefile]);
				}
			}

		}
		return true;
	}

	//////////////////////////////////////////////////////////////////////

	function ResolveSource() {
		if (is_resource($this->gdimg_source)) {
			return true;
		}
		if ($this->rawImageData) {
			$this->sourceFilename = null;
			return true;
		}
		if ($this->sourceFilename) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->sourceFilename);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'"', __FILE__, __LINE__);
		} else {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->src);
			$this->DebugMessage('$this->sourceFilename set to "'.$this->sourceFilename.'" from $this->src ('.$this->src.')', __FILE__, __LINE__);
		}
		if ($this->iswindows && ((substr($this->sourceFilename, 0, 2) == '//') || (substr($this->sourceFilename, 0, 2) == '\\\\'))) {
			// Windows \\share\filename.ext
		} elseif (eregi('^(f|ht)tps?://', $this->sourceFilename)) {
			// URL
		} elseif (!file_exists($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" does not exist');
		} elseif (!is_file($this->sourceFilename)) {
			return $this->ErrorImage('"'.$this->sourceFilename.'" is not a file');
		}
		return true;
	}

	function setOutputFormat() {
		static $alreadyCalled = false;
		if ($this->thumbnailFormat && $alreadyCalled) {
			return true;
		}
		$alreadyCalled = true;

		$AvailableImageOutputFormats = array();
		$AvailableImageOutputFormats[] = 'text';
		$this->thumbnailFormat         = 'text';

		// Set default output format based on what image types are available
		if (!function_exists('ImageTypes')) {
			return $this->ErrorImage('ImageTypes() does not exist - GD support might not be enabled?');
		}
		$imagetypes = ImageTypes();
		if ($imagetypes & IMG_WBMP) {
			$this->thumbnailFormat         = 'wbmp';
			$AvailableImageOutputFormats[] = 'wbmp';
		}
		if ($imagetypes & IMG_GIF) {
			$this->thumbnailFormat         = 'gif';
			$AvailableImageOutputFormats[] = 'gif';
		}
		if ($imagetypes & IMG_PNG) {
			$this->thumbnailFormat         = 'png';
			$AvailableImageOutputFormats[] = 'png';
		}
		if ($imagetypes & IMG_JPG) {
			$this->thumbnailFormat         = 'jpeg';
			$AvailableImageOutputFormats[] = 'jpeg';
		}
		$this->DebugMessage('$AvailableImageOutputFormats = array('.implode(';', $AvailableImageOutputFormats).')', __FILE__, __LINE__);

		if (strtolower($this->config_output_format) == 'jpg') {
			$this->config_output_format = 'jpeg';
		}
		if (strtolower($this->f) == 'jpg') {
			$this->f = 'jpeg';
		}
		if (in_array(strtolower($this->config_output_format), $AvailableImageOutputFormats)) {
			// set output format to config default if that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->config_output_format "'.strtolower($this->config_output_format).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->config_output_format);
		} elseif ($this->config_output_format) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->config_output_format ('.strtolower($this->config_output_format).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}
		if ($this->f && (in_array(strtolower($this->f), $AvailableImageOutputFormats))) {
			// override output format if $this->f is set and that format is available
			$this->DebugMessage('$this->thumbnailFormat set to $this->f "'.strtolower($this->f).'"', __FILE__, __LINE__);
			$this->thumbnailFormat = strtolower($this->f);
		} elseif ($this->f) {
			$this->DebugMessage('$this->thumbnailFormat staying as "'.$this->thumbnailFormat.'" because $this->f ('.strtolower($this->f).') is not in $AvailableImageOutputFormats', __FILE__, __LINE__);
		}

		// for JPEG images, quality 1 (worst) to 99 (best)
		// quality < 25 is nasty, with not much size savings - not recommended
		// problems with 100 - invalid JPEG?
		$this->thumbnailQuality = max(1, min(99, ($this->q ? $this->q : 75)));
		$this->DebugMessage('$this->thumbnailQuality set to "'.$this->thumbnailQuality.'"', __FILE__, __LINE__);

		return true;
	}

	function setCacheDirectory() {
		// resolve cache directory to absolute pathname
		if (substr($this->config_cache_directory, 0, 1) == '.') {
			if (eregi('^(f|ht)tps?://', $this->src)) {
				if (!$this->config_cache_disable_warning && !$this->phpThumbDebug) {
					$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') cannot be used for remote images. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
				}
			} elseif ($this->src) {
				// resolve relative cache directory to source image
				$this->config_cache_directory = dirname($this->ResolveFilenameToAbsolute($this->src)).$this->osslash.$this->config_cache_directory;
			} else {
				// $this->new is probably set
			}
		}
		if (substr($this->config_cache_directory, -1) == '/') {
			$this->config_cache_directory = substr($this->config_cache_directory, 0, -1);
		}
		if ($this->iswindows) {
			$this->config_cache_directory = str_replace('/', $this->osslash, $this->config_cache_directory);
		}
		if ($this->config_cache_directory) {
			$real_cache_path = realpath($this->config_cache_directory);
			if (!$real_cache_path) {
				$this->DebugMessage('realpath($this->config_cache_directory) failed for "'.$this->config_cache_directory.'"', __FILE__, __LINE__);
				if (!is_dir($this->config_cache_directory)) {
					$this->DebugMessage('!is_dir('.$this->config_cache_directory.')', __FILE__, __LINE__);
				}
			}
			if ($real_cache_path) {
				$this->config_cache_directory = $real_cache_path;
			}
		}
		if (!is_dir($this->config_cache_directory)) {
			if (!$this->config_cache_disable_warning && !$this->phpThumbDebug) {
				$this->ErrorImage('$this->config_cache_directory ('.$this->config_cache_directory.') does not exist. Adjust "cache_directory" or "cache_disable_warning" in phpThumb.config.php');
			}
			$this->DebugMessage('$this->config_cache_directory ('.$this->config_cache_directory.') is not a directory', __FILE__, __LINE__);
			$this->config_cache_directory = null;
		} elseif (!is_writable($this->config_cache_directory)) {
			$this->DebugMessage('$this->config_cache_directory is not writable ('.$this->config_cache_directory.')', __FILE__, __LINE__);
		}
		return true;
	}

	function ResolveFilenameToAbsolute($filename) {
		if (eregi('^(f|ht)tps?://', $filename)) {

			// URL
			$AbsoluteFilename = $filename;

		} elseif ($this->iswindows && ($filename{1} == ':')) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($this->iswindows && ((substr($filename, 0, 2) == '//') || (substr($filename, 0, 2) == '\\\\'))) {

			// absolute pathname (Windows)
			$AbsoluteFilename = $filename;

		} elseif ($filename{0} == '/') {

			if (@is_readable($filename) && !@is_readable($this->config_document_root.$filename)) {
				// absolute filename (*nix)
				$AbsoluteFilename = $filename;
			} elseif ($filename{1} == '~') {
				// /~user/path
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray($filename)) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'];
				} else {
					$AbsoluteFilename = realpath($filename);
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath($filename)', __FILE__, __LINE__);
					} else {
						if ($this->phpThumbDebug) {
							$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'". This has been known to fail on Apache2 - try using the absolute filename for the source image');
							return false;
						} else {
							return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.$filename.'". This has been known to fail on Apache2 - try using the absolute filename for the source image');
						}
					}
				}
			} else {
				// relative filename (any OS)
				$AbsoluteFilename = $this->config_document_root.$filename;
			}

		} else {

			// relative to current directory (any OS)
			$AbsoluteFilename = $this->config_document_root.dirname(@$_SERVER['PHP_SELF']).$this->osslash.$filename;
			//if (!file_exists($AbsoluteFilename) && file_exists(realpath($this->DotPadRelativeDirectoryPath($filename)))) {
			//	$AbsoluteFilename = realpath($this->DotPadRelativeDirectoryPath($filename));
			//}

			if (substr(dirname(@$_SERVER['PHP_SELF']), 0, 2) == '/~') {
				if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray(dirname(@$_SERVER['PHP_SELF']))) {
					$AbsoluteFilename = $ApacheLookupURIarray['filename'].$this->osslash.$filename;
				} else {
					$AbsoluteFilename = realpath('.').$this->osslash.$filename;
					if (@is_readable($AbsoluteFilename)) {
						$this->DebugMessage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'", but the correct filename ('.$AbsoluteFilename.') seems to have been resolved with realpath(.)/$filename', __FILE__, __LINE__);
					} else {
						return $this->ErrorImage('phpthumb_functions::ApacheLookupURIarray() failed for "'.dirname(@$_SERVER['PHP_SELF']).'". This has been known to fail on Apache2 - try using the absolute filename for the source image');
					}
				}
			}

		}
		if (is_link($AbsoluteFilename)) {
			$this->DebugMessage('is_link()==true, changing "'.$AbsoluteFilename.'" to "'.readlink($AbsoluteFilename).'"', __FILE__, __LINE__);
			$AbsoluteFilename = readlink($AbsoluteFilename);
		}
		if (realpath($AbsoluteFilename)) {
			$AbsoluteFilename = realpath($AbsoluteFilename);
		}
		if ($this->iswindows) {
			$AbsoluteFilename = eregi_replace('^'.preg_quote(realpath($this->config_document_root)), realpath($this->config_document_root), $AbsoluteFilename);
			$AbsoluteFilename = str_replace($this->osslash, '/', $AbsoluteFilename);
		}
		if (!$this->config_allow_src_above_docroot && !ereg('^'.preg_quote(str_replace($this->osslash, '/', realpath($this->config_document_root))), $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_docroot therefore setting "'.$AbsoluteFilename.'" to null', __FILE__, __LINE__);
			return false;
		}
		if (!$this->config_allow_src_above_phpthumb && !ereg('^'.preg_quote(str_replace($this->osslash, '/', dirname(__FILE__))), $AbsoluteFilename)) {
			$this->DebugMessage('!$this->config_allow_src_above_phpthumb therefore setting "'.$AbsoluteFilename.'" to null', __FILE__, __LINE__);
			return false;
		}
		return $AbsoluteFilename;
	}

	function ImageMagickCommandlineBase() {
		static $commandline = null;
		if (is_null($commandline)) {
			$commandline = '';

			$which_convert = trim(phpthumb_functions::SafeExec('which convert'));

			if ($this->config_imagemagick_path && ($this->config_imagemagick_path != realpath($this->config_imagemagick_path))) {
				$this->DebugMessage('Changing $this->config_imagemagick_path ('.$this->config_imagemagick_path.') to realpath($this->config_imagemagick_path) ('.realpath($this->config_imagemagick_path).')', __FILE__, __LINE__);
				$this->config_imagemagick_path = realpath($this->config_imagemagick_path);
			}
			if (file_exists($this->config_imagemagick_path)) {

				$this->DebugMessage('using ImageMagick path from $this->config_imagemagick_path ('.$this->config_imagemagick_path.')', __FILE__, __LINE__);
				if ($this->iswindows) {
					$commandline = substr($this->config_imagemagick_path, 0, 2).' && cd "'.substr(dirname($this->config_imagemagick_path), 2).'" && '.basename($this->config_imagemagick_path);
				} else {
					$commandline = '"'.$this->config_imagemagick_path.'"';
				}

			} elseif ($which_convert && ($which_convert{0} == '/') && @file_exists($which_convert)) {

				// `which convert` *should* return the path if "convert" exist, or nothing if it doesn't
				// other things *may* get returned, like "sh: convert: not found" or "no convert in /usr/local/bin /usr/sbin /usr/bin /usr/ccs/bin"
				// so only do this if the value returned exists as a file
				$this->DebugMessage('using ImageMagick path from `which convert` ('.$which_convert.')', __FILE__, __LINE__);
				$commandline = 'convert';

			} else {

				$this->DebugMessage('ImageMagickThumbnailToGD() aborting because cannot find convert in $this->config_imagemagick_path ('.$this->config_imagemagick_path.'), and `which convert` returned ('.$which_convert.')', __FILE__, __LINE__);

			}
		}
		return $commandline;
	}

	function ImageMagickVersion() {
		static $versionstring = null;
		if (is_null($versionstring)) {
			$commandline = $this->ImageMagickCommandlineBase();
			if ($commandline) {
				$commandline .= ' -version';
				$versionstring = phpthumb_functions::SafeExec($commandline);
				if (eregi('^Version: (.*) http', $versionstring, $matches)) {
					return $matches[1];
				}
				$this->DebugMessage('ImageMagick did not return recognized version string ('.$versionstring.')', __FILE__, __LINE__);
			}
		}
		return $versionstring;
	}

	function ImageMagickThumbnailToGD() {
		$GIFtemp = ((@$this->getimagesizeinfo[2] == 1) && ($this->thumbnailFormat == 'gif'));
		$ImageCreateFunction = ($GIFtemp ? 'ImageCreateFromGIF' : 'ImageCreateFromPNG');

		// http://freealter.org/doc_distrib/ImageMagick-5.1.1/www/convert.html
		if (ini_get('safe_mode')) {
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because safe_mode is enabled', __FILE__, __LINE__);
			return false;
		}
		if (!function_exists('ImageCreateFromPNG')) {
			// ImageMagickThumbnailToGD() depends on ImageCreateFromPNG()
			$this->DebugMessage('ImageMagickThumbnailToGD() aborting because ImageCreateFromPNG() is not available', __FILE__, __LINE__);
			return false;
		}

		$commandline = $this->ImageMagickCommandlineBase();
		if ($commandline) {
			if ($IMtempfilename = $this->phpThumb_tempnam()) {

				$IMtempfilename = realpath($IMtempfilename);
				$this->source_width  = max($this->w, $this->wp, $this->wl, $this->ws);
				$this->source_height = max($this->h, $this->hp, $this->hl, $this->hs);
				$this->DebugMessage('source dimensions set to '.$this->source_width.'x'.$this->source_height, __FILE__, __LINE__);
				if (!$this->aoe && !$this->iar && ($getimagesize = @GetImageSize($this->sourceFilename))) {
					// limit output size to input size unless AllowOutputEnlargement is enabled
					$this->source_width  = min($this->source_width,  $getimagesize[0]);
					$this->source_height = min($this->source_height, $getimagesize[1]);
					$this->DebugMessage('source dimensions reset to '.$this->source_width.'x'.$this->source_height, __FILE__, __LINE__);
					$this->SetOrientationDependantWidthHeight();
					if ($this->zc) {
						$ar = max($getimagesize[0] / $getimagesize[1], $getimagesize[1] / $getimagesize[0]);
						$this->source_width  = round($this->source_width  * $ar);
						$this->source_height = round($this->source_height * $ar);
						$this->DebugMessage('source dimensions reset by "zc" to '.$this->source_width.'x'.$this->source_height, __FILE__, __LINE__);
					}
				}
				$commandline .= ' -coalesce '; // may be needed for animaged GIFs
				//$commandline .= ' -resize '.$this->source_width.'x'.$this->source_height; // behaves badly with IM v5.3.x
				$commandline .= ' -geometry '.$this->source_width.'x'.$this->source_height;
				if ($this->iar && (intval($this->w) > 0) && (intval($this->h) > 0)) {
					$commandline .= '!';
				}
				$commandline .= ' "'.str_replace('/', $this->osslash, $this->sourceFilename).'"';
				$commandline .= ' '.($GIFtemp ? 'gif' : 'png').':'.$IMtempfilename;
				$commandline .= ' 2>&1';

				$this->DebugMessage('ImageMagick called as ('.$commandline.')', __FILE__, __LINE__);
				$IMresult = phpthumb_functions::SafeExec($commandline);
				if ($IMresult) {

					//return $this->ErrorImage('ImageMagick was called as:'."\n".$commandline."\n\n".'but failed with message:'."\n".$IMresult);
					$this->DebugMessage('ImageMagick failed with message ('.$IMresult.')', __FILE__, __LINE__);

				} elseif ($this->gdimg_source = @$ImageCreateFunction($IMtempfilename)) {

					$this->IMresizedData = file_get_contents($IMtempfilename);
					@unlink($IMtempfilename);
					$this->source_width  = ImageSX($this->gdimg_source);
					$this->source_height = ImageSY($this->gdimg_source);
					$this->DebugMessage('ImageMagickThumbnailToGD::'.$ImageCreateFunction.'() succeeded, $this->gdimg_source is now ('.$this->source_width.'x'.$this->source_height.')', __FILE__, __LINE__);
					$this->DebugMessage('ImageMagickThumbnailToGD() returning $IMresizedData ('.strlen($this->IMresizedData).' bytes)', __FILE__, __LINE__);
					return true;

				}
				unlink($IMtempfilename);

			} else {
				$this->DebugMessage('ImageMagickThumbnailToGD() aborting, phpThumb_tempnam() failed', __FILE__, __LINE__);
			}
		}
		$this->DebugMessage('ImageMagickThumbnailToGD() aborting because ImageMagickCommandlineBase() failed', __FILE__, __LINE__);
		return false;
	}

	function Rotate() {
		if ($this->ra || $this->ar) {
			if (!function_exists('ImageRotate')) {
				//$this->DebugMessage('!function_exists(ImageRotate)', __FILE__, __LINE__);
				//return false;
				// Code by Dominik Scholz: http://php.net/manual/en/function.imagerotate.php#82261
				function imagerotate($src_img, $angle) {
					$src_x = imagesx($src_img);
					$src_y = imagesy($src_img);
					if ($angle == 180) {
						$dest_x = $src_x;
						$dest_y = $src_y;
					} elseif (($angle == 90) || ($angle == 270)) {
						$dest_x = $src_y;
						$dest_y = $src_x;
					} else {
						return $src_img;
					}

					$rotate=imagecreatetruecolor($dest_x,$dest_y);
					imagealphablending($rotate, false);

					switch ($angle) {
						case 270:
							$dest_x--;
							for ($y = 0; $y < $src_y; $y++)
							for ($x = 0; $x < $src_x; $x++)
								imagesetpixel($rotate, $dest_x - $y, $x, imagecolorat($src_img, $x, $y));
							break;
						case 90:
							$dest_y--;
							for ($y = 0; $y < $src_y; $y++)
							for ($x = 0; $x < $src_x; $x++)
								imagesetpixel($rotate, $y, $dest_y - $x, imagecolorat($src_img, $x, $y));
							break;
						case 180:
							$dest_x--;
							$dest_y--;
							for ($y = 0; $y < $src_y; $y++)
							for ($x = 0; $x < $src_x; $x++)
								imagesetpixel($rotate, $dest_x - $x, $dest_y - $y, imagecolorat($src_img, $x, $y));
							break;
					}
					return $rotate;
				}
			}
			if (!include_once(dirname(__FILE__).'/phpthumb.filters.php')) {
				$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.filters.php" which is required for applying filters ('.implode(';', $this->fltr).')', __FILE__, __LINE__);
				return false;
			}

			$this->config_background_hexcolor = ($this->bg ? $this->bg : $this->config_background_hexcolor);
			if (!phpthumb_functions::IsHexColor($this->config_background_hexcolor)) {
				return $this->ErrorImage('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "bg"');
			}

			$rotate_angle = 0;
			if ($this->ra) {

				$rotate_angle = floatval($this->ra);

			} else {

				if ($this->ar == 'x') {
					if (phpthumb_functions::version_compare_replacement(phpversion(), '4.2.0', '>=')) {
						if ($this->sourceFilename) {
							if (function_exists('exif_read_data')) {
								if ($exif_data = @exif_read_data($this->sourceFilename, 'IFD0')) {
									// http://sylvana.net/jpegcrop/exif_orientation.html
									switch (@$exif_data['Orientation']) {
										case 1:
											$rotate_angle = 0;
											break;
										case 3:
											$rotate_angle = 180;
											break;
										case 6:
											$rotate_angle = 270;
											break;
										case 8:
											$rotate_angle = 90;
											break;

										default:
											$this->DebugMessage('EXIF auto-rotate failed because unknown $exif_data[Orientation] "'.@$exif_data['Orientation'].'"', __FILE__, __LINE__);
											return false;
											break;
									}
									$this->DebugMessage('EXIF auto-rotate set to '.$rotate_angle.' degrees ($exif_data[Orientation] = "'.@$exif_data['Orientation'].'")', __FILE__, __LINE__);
								} else {
									$this->DebugMessage('failed: exif_read_data('.$this->sourceFilename.')', __FILE__, __LINE__);
									return false;
								}
							} else {
								$this->DebugMessage('!function_exists(exif_read_data)', __FILE__, __LINE__);
								return false;
							}
						} else {
							$this->DebugMessage('Cannot auto-rotate from EXIF data because $this->sourceFilename is empty', __FILE__, __LINE__);
							return false;
						}
					} else {
						$this->DebugMessage('Cannot auto-rotate from EXIF data because PHP is less than v4.2.0 ('.phpversion().')', __FILE__, __LINE__);
						return false;
					}
				} elseif (($this->ar == 'l') && ($this->source_height > $this->source_width)) {
					$rotate_angle = 270;
				} elseif (($this->ar == 'L') && ($this->source_height > $this->source_width)) {
					$rotate_angle = 90;
				} elseif (($this->ar == 'p') && ($this->source_width > $this->source_height)) {
					$rotate_angle = 90;
				} elseif (($this->ar == 'P') && ($this->source_width > $this->source_height)) {
					$rotate_angle = 270;
				}

			}
			while ($rotate_angle < 0) {
				$rotate_angle += 360;
			}
			$rotate_angle = $rotate_angle % 360;
			if ($rotate_angle != 0) {

				$background_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_source, $this->config_background_hexcolor);

				if ((phpthumb_functions::gd_version() >= 2) && ($this->thumbnailFormat == 'png') && !$this->bg && ($rotate_angle % 90)) {

					if ($gdimg_rotate_mask = phpthumb_functions::ImageCreateFunction(ImageSX($this->gdimg_source), ImageSY($this->gdimg_source))) {

						$this->gdimg_source = ImageRotate($this->gdimg_source, $rotate_angle, $background_color);
						$color_mask_opaque      = ImageColorAllocate($gdimg_rotate_mask, 0xFF, 0xFF, 0xFF);
						$color_mask_transparent = ImageColorAllocate($gdimg_rotate_mask, 0x00, 0x00, 0x00);
						ImageFilledRectangle($gdimg_rotate_mask, 0, 0, ImageSX($gdimg_rotate_mask), ImageSY($gdimg_rotate_mask), $color_mask_opaque);
						$gdimg_rotate_mask = ImageRotate($gdimg_rotate_mask, $rotate_angle, $color_mask_transparent);

						ImageAlphaBlending($this->gdimg_source, false);
						if (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.2', '>=')) {
							ImageSaveAlpha($this->gdimg_source, true);
						}
						$this->is_alpha = true;
						phpthumb_filters::ApplyMask($gdimg_rotate_mask, $this->gdimg_source);

						ImageDestroy($gdimg_rotate_mask);
						$this->source_width  = ImageSX($this->gdimg_source);
						$this->source_height = ImageSY($this->gdimg_source);

					} else {
						$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$MaskFilename.'"', __FILE__, __LINE__);
					}

				} else {

					if (phpthumb_functions::gd_version() >= 2) {
						$this->DebugMessage('Using non-alpha rotate because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
					} else {
						$this->DebugMessage('Using non-alpha rotate because $this->thumbnailFormat is "'.$this->thumbnailFormat.'"', __FILE__, __LINE__);
					}

					if (ImageColorTransparent($this->gdimg_source) >= 0) {
						// ImageRotate() forgets all about an image's transparency and sets the transparent color to black
						// To compensate, flood-fill the transparent color of the source image with the specified background color first
						// then rotate and the colors should match

						if (!function_exists('ImageIsTrueColor') || !ImageIsTrueColor($this->gdimg_source)) {
							// convert paletted image to true-color before rotating to prevent nasty aliasing artifacts

							$this->source_width  = ImageSX($this->gdimg_source);
							$this->source_height = ImageSY($this->gdimg_source);
							$gdimg_newsrc = phpthumb_functions::ImageCreateFunction($this->source_width, $this->source_height);
							$background_color = phpthumb_functions::ImageHexColorAllocate($gdimg_newsrc, $this->config_background_hexcolor);
							ImageFilledRectangle($gdimg_newsrc, 0, 0, $this->source_width, $this->source_height, phpthumb_functions::ImageHexColorAllocate($gdimg_newsrc, $this->config_background_hexcolor));
							ImageCopy($gdimg_newsrc, $this->gdimg_source, 0, 0, 0, 0, $this->source_width, $this->source_height);
							ImageDestroy($this->gdimg_source);
							unset($this->gdimg_source);
							$this->gdimg_source = $gdimg_newsrc;
							unset($gdimg_newsrc);

						} else {

							ImageColorSet(
								$this->gdimg_source,
								ImageColorTransparent($this->gdimg_source),
								hexdec(substr($this->config_background_hexcolor, 0, 2)),
								hexdec(substr($this->config_background_hexcolor, 2, 2)),
								hexdec(substr($this->config_background_hexcolor, 4, 2)));

							ImageColorTransparent($this->gdimg_source, -1);

						}
					}

					$this->gdimg_source = ImageRotate($this->gdimg_source, $rotate_angle, $background_color);
					$this->source_width  = ImageSX($this->gdimg_source);
					$this->source_height = ImageSY($this->gdimg_source);

				}
			}
		}
		return true;
	}

	function FixedAspectRatio() {
		// optional fixed-dimension images (regardless of aspect ratio)

		if (!$this->far) {
			// do nothing
			return true;
		}

		if (!$this->w || !$this->h) {
			return false;
		}
		$this->thumbnail_width  = $this->w;
		$this->thumbnail_height = $this->h;
		$this->is_alpha = true;
		if ($this->thumbnail_image_width >= $this->thumbnail_width) {

			if ($this->w) {
				$aspectratio = $this->thumbnail_image_height / $this->thumbnail_image_width;
				$this->thumbnail_image_height = round($this->thumbnail_image_width * $aspectratio);
				if (!$this->h) {
					$this->thumbnail_height = $this->thumbnail_image_height;
				}
			} elseif ($this->thumbnail_image_height < $this->thumbnail_height) {
				$this->thumbnail_image_height = $this->thumbnail_height;
				$this->thumbnail_image_width  = round($this->thumbnail_image_height / $aspectratio);
			}

		} else {

			if ($this->h) {
				$aspectratio = $this->thumbnail_image_width / $this->thumbnail_image_height;
				$this->thumbnail_image_width = round($this->thumbnail_image_height * $aspectratio);
			} elseif ($this->thumbnail_image_width < $this->thumbnail_width) {
				$this->thumbnail_image_width = $this->thumbnail_width;
				$this->thumbnail_image_height  = round($this->thumbnail_image_width / $aspectratio);
			}

		}
		return true;
	}

	function AntiOffsiteLinking() {
		// Optional anti-offsite hijacking of the thumbnail script
		$allow = true;
		if ($allow && $this->config_nooffsitelink_enabled && $this->config_nooffsitelink_require_refer) {
			$this->DebugMessage('AntiOffsiteLinking() checking $_SERVER[HTTP_REFERER] "'.@$_SERVER['HTTP_REFERER'].'"', __FILE__, __LINE__);
			$parsed_url = parse_url(@$_SERVER['HTTP_REFERER']);
			if (!in_array(@$parsed_url['host'], $this->config_nooffsitelink_valid_domains)) {
				$allow = false;
				$erase   = $this->config_nooffsitelink_erase_image;
				$message = $this->config_nooffsitelink_text_message;
				$this->DebugMessage('AntiOffsiteLinking() - "'.@$parsed_url['host'].'" is NOT in $this->config_nooffsitelink_valid_domains ('.implode(';', $this->config_nooffsitelink_valid_domains).')', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('AntiOffsiteLinking() - "'.@$parsed_url['host'].'" is in $this->config_nooffsitelink_valid_domains ('.implode(';', $this->config_nooffsitelink_valid_domains).')', __FILE__, __LINE__);
			}
		}

		if ($allow && $this->config_nohotlink_enabled && eregi('^(f|ht)tps?://', $this->src)) {
			$parsed_url = parse_url($this->src);
			if (!in_array(@$parsed_url['host'], $this->config_nohotlink_valid_domains)) {
				// This domain is not allowed
				$allow = false;
				$erase   = $this->config_nohotlink_erase_image;
				$message = $this->config_nohotlink_text_message;
				$this->DebugMessage('AntiOffsiteLinking() - "'.$parsed_url['host'].'" is NOT in $this->config_nohotlink_valid_domains ('.implode(';', $this->config_nohotlink_valid_domains).')', __FILE__, __LINE__);
			} else {
				$this->DebugMessage('AntiOffsiteLinking() - "'.$parsed_url['host'].'" is in $this->config_nohotlink_valid_domains ('.implode(';', $this->config_nohotlink_valid_domains).')', __FILE__, __LINE__);
			}
		}

		if ($allow) {
			$this->DebugMessage('AntiOffsiteLinking() says this is allowed', __FILE__, __LINE__);
			return true;
		}

		if (!phpthumb_functions::IsHexColor($this->config_error_bgcolor)) {
			return $this->ErrorImage('Invalid hex color string "'.$this->config_error_bgcolor.'" for $this->config_error_bgcolor');
		}
		if (!phpthumb_functions::IsHexColor($this->config_error_textcolor)) {
			return $this->ErrorImage('Invalid hex color string "'.$this->config_error_textcolor.'" for $this->config_error_textcolor');
		}
		if ($erase) {

			return $this->ErrorImage($message, $this->thumbnail_width, $this->thumbnail_height, $this->config_error_bgcolor, $this->config_error_textcolor, $this->config_error_fontsize);

		} else {

			$nohotlink_text_array = explode("\n", wordwrap($message, floor($this->thumbnail_width / ImageFontWidth($this->config_error_fontsize)), "\n"));
			$nohotlink_text_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_output, $this->config_error_textcolor);

			$topoffset = round(($this->thumbnail_height - (count($nohotlink_text_array) * ImageFontHeight($this->config_error_fontsize))) / 2);

			$rowcounter = 0;
			$this->DebugMessage('AntiOffsiteLinking() writing '.count($nohotlink_text_array).' lines of text "'.$message.'" (in #'.$this->config_error_textcolor.') on top of image', __FILE__, __LINE__);
			foreach ($nohotlink_text_array as $textline) {
				$leftoffset = max(0, round(($this->thumbnail_width - (strlen($textline) * ImageFontWidth($this->config_error_fontsize))) / 2));
				ImageString($this->gdimg_output, $this->config_error_fontsize, $leftoffset, $topoffset + ($rowcounter++ * ImageFontHeight($this->config_error_fontsize)), $textline, $nohotlink_text_color);
			}

		}
		return true;
	}

	function AlphaChannelFlatten() {
		if (!$this->is_alpha) {
			// image doesn't have alpha transparency, no need to flatten
			$this->DebugMessage('skipping AlphaChannelFlatten() because !$this->is_alpha', __FILE__, __LINE__);
			return false;
		}
		if ($this->thumbnailFormat == 'png') {

			// image has alpha transparency, but output as PNG which can handle it
			$this->DebugMessage('skipping AlphaChannelFlatten() because ($this->thumbnailFormat == "'.$this->thumbnailFormat.'")', __FILE__, __LINE__);
			return false;

		} elseif ($this->thumbnailFormat == 'gif') {

			// image has alpha transparency, but output as GIF which can handle only single-color transparency
			$CurrentImageColorTransparent = ImageColorTransparent($this->gdimg_output);
			if ($CurrentImageColorTransparent == -1) {
				// no transparent color defined

				if (phpthumb_functions::gd_version() < 2.0) {
					$this->DebugMessage('AlphaChannelFlatten() failed because GD version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
					return false;
				}

				if ($img_alpha_mixdown_dither = @ImageCreateTrueColor(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output))) {

					for ($i = 0; $i <= 255; $i++) {
						$dither_color[$i] = ImageColorAllocate($img_alpha_mixdown_dither, $i, $i, $i);
					}

					// scan through current truecolor image copy alpha channel to temp image as grayscale
					for ($x = 0; $x < $this->thumbnail_width; $x++) {
						for ($y = 0; $y < $this->thumbnail_height; $y++) {
							$PixelColor = phpthumb_functions::GetPixelColor($this->gdimg_output, $x, $y);
							ImageSetPixel($img_alpha_mixdown_dither, $x, $y, $dither_color[($PixelColor['alpha'] * 2)]);
						}
					}

					// dither alpha channel grayscale version down to 2 colors
					ImageTrueColorToPalette($img_alpha_mixdown_dither, true, 2);

					// reduce color palette to 256-1 colors (leave one palette position for transparent color)
					ImageTrueColorToPalette($this->gdimg_output, true, 255);

					// allocate a new color for transparent color index
					$TransparentColor = ImageColorAllocate($this->gdimg_output, 1, 254, 253);
					ImageColorTransparent($this->gdimg_output, $TransparentColor);

					// scan through alpha channel image and note pixels with >50% transparency
					$TransparentPixels = array();
					for ($x = 0; $x < $this->thumbnail_width; $x++) {
						for ($y = 0; $y < $this->thumbnail_height; $y++) {
							$AlphaChannelPixel = phpthumb_functions::GetPixelColor($img_alpha_mixdown_dither, $x, $y);
							if ($AlphaChannelPixel['red'] > 127) {
								ImageSetPixel($this->gdimg_output, $x, $y, $TransparentColor);
							}
						}
					}
					ImageDestroy($img_alpha_mixdown_dither);

					$this->DebugMessage('AlphaChannelFlatten() set image to 255+1 colors with transparency for GIF output', __FILE__, __LINE__);
					return true;

				} else {
					$this->DebugMessage('AlphaChannelFlatten() failed ImageCreate('.ImageSX($this->gdimg_output).', '.ImageSY($this->gdimg_output).')', __FILE__, __LINE__);
					return false;
				}

			} else {
				// a single transparent color already defined, leave as-is
				$this->DebugMessage('skipping AlphaChannelFlatten() because ($this->thumbnailFormat == "'.$this->thumbnailFormat.'") and ImageColorTransparent returned "'.$CurrentImageColorTransparent.'"', __FILE__, __LINE__);
				return true;
			}

		}
		$this->DebugMessage('continuing AlphaChannelFlatten() for output format "'.$this->thumbnailFormat.'"', __FILE__, __LINE__);

		// image has alpha transparency, and is being output in a format that doesn't support it -- flatten
		if ($gdimg_flatten_temp = phpthumb_functions::ImageCreateFunction($this->thumbnail_width, $this->thumbnail_height)) {

			$this->config_background_hexcolor = ($this->bg ? $this->bg : $this->config_background_hexcolor);
			if (!phpthumb_functions::IsHexColor($this->config_background_hexcolor)) {
				return $this->ErrorImage('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "bg"');
			}
			$background_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_output, $this->config_background_hexcolor);
			ImageFilledRectangle($gdimg_flatten_temp, 0, 0, $this->thumbnail_width, $this->thumbnail_height, $background_color);
			ImageCopy($gdimg_flatten_temp, $this->gdimg_output, 0, 0, 0, 0, $this->thumbnail_width, $this->thumbnail_height);

			ImageAlphaBlending($this->gdimg_output, true);
			if (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.2', '>=')) {
				ImageSaveAlpha($this->gdimg_output, false);
			}
			ImageColorTransparent($this->gdimg_output, -1);
			ImageCopy($this->gdimg_output, $gdimg_flatten_temp, 0, 0, 0, 0, $this->thumbnail_width, $this->thumbnail_height);

			ImageDestroy($gdimg_flatten_temp);
			return true;

		} else {
			$this->DebugMessage('ImageCreateFunction() failed', __FILE__, __LINE__);
		}
		return false;
	}

	function ApplyFilters() {
		if ($this->fltr && is_array($this->fltr)) {
			if (!include_once(dirname(__FILE__).'/phpthumb.filters.php')) {
				$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.filters.php" which is required for applying filters ('.implode(';', $this->fltr).')', __FILE__, __LINE__);
				return false;
			}
			foreach ($this->fltr as $filtercommand) {
				@list($command, $parameter) = explode('|', $filtercommand, 2);
				$this->DebugMessage('Attempting to process filter command "'.$command.'"', __FILE__, __LINE__);
				switch ($command) {
					case 'brit':
						phpthumb_filters::Brightness($this->gdimg_output, $parameter);
						break;

					case 'cont':
						phpthumb_filters::Contrast($this->gdimg_output, $parameter);
						break;

					case 'ds':
						phpthumb_filters::Desaturate($this->gdimg_output, $parameter, '');
						break;

					case 'sat':
						phpthumb_filters::Saturation($this->gdimg_output, $parameter, '');
						break;

					case 'gray':
						phpthumb_filters::Grayscale($this->gdimg_output);
						break;

					case 'clr':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Colorize() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($amount, $color) = explode('|', $parameter);
						phpthumb_filters::Colorize($this->gdimg_output, $amount, $color);
						break;

					case 'sep':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Sepia() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($amount, $color) = explode('|', $parameter);
						phpthumb_filters::Sepia($this->gdimg_output, $amount, $color);
						break;

					case 'gam':
						phpthumb_filters::Gamma($this->gdimg_output, $parameter);
						break;

					case 'neg':
						phpthumb_filters::Negative($this->gdimg_output);
						break;

					case 'th':
						phpthumb_filters::Threshold($this->gdimg_output, $parameter);
						break;

					case 'rcd':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping ReduceColorDepth() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($colors, $dither) = explode('|', $parameter);
						$colors = ($colors                ?  (int) $colors : 256);
						$dither  = ((strlen($dither) > 0) ? (bool) $dither : true);
						phpthumb_filters::ReduceColorDepth($this->gdimg_output, $colors, $dither);
						break;

					case 'flip':
						phpthumb_filters::Flip($this->gdimg_output, (strpos(strtolower($parameter), 'x') !== false), (strpos(strtolower($parameter), 'y') !== false));
						break;

					case 'edge':
						phpthumb_filters::EdgeDetect($this->gdimg_output);
						break;

					case 'emb':
						phpthumb_filters::Emboss($this->gdimg_output);
						break;

					case 'bvl':
						@list($width, $color1, $color2) = explode('|', $parameter);
						phpthumb_filters::Bevel($this->gdimg_output, $width, $color1, $color2);
						break;

					case 'lvl':
						@list($band, $min, $max) = explode('|', $parameter);
						$band = ($band              ? $band : '*');
						$min  = ((strlen($min) > 0) ? $min  : '-1');
						$max  = ((strlen($max) > 0) ? $max  : '-1');
						phpthumb_filters::HistogramStretch($this->gdimg_output, $band, $min, $max);
						break;

					case 'wb':
						phpthumb_filters::WhiteBalance($this->gdimg_output, $parameter);
						break;

					case 'hist':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping HistogramOverlay() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							break;
						}
						@list($bands, $colors, $width, $height, $alignment, $opacity, $margin) = explode('|', $parameter);
						$bands     = ($bands     ? $bands     :  '*');
						$colors    = ($colors    ? $colors    :   '');
						$width     = ($width     ? $width     : 0.25);
						$height    = ($height    ? $height    : 0.25);
						$alignment = ($alignment ? $alignment : 'BR');
						$opacity   = ($opacity   ? $opacity   :   50);
						$margin    = ($margin    ? $margin    :    5);
						phpthumb_filters::HistogramOverlay($this->gdimg_output, $bands, $colors, $width, $height, $alignment, $opacity, $margin);
						break;

					case 'fram':
						@list($frame_width, $edge_width, $color_frame, $color1, $color2) = explode('|', $parameter);
						phpthumb_filters::Frame($this->gdimg_output, $frame_width, $edge_width, $color_frame, $color1, $color2);
						break;

					case 'drop':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping DropShadow() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$this->is_alpha = true;
						@list($distance, $width, $color, $angle, $fade) = explode('|', $parameter);
						phpthumb_filters::DropShadow($this->gdimg_output, $distance, $width, $color, $angle, $fade);
						break;

					case 'mask':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Mask() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$mask_filename = $this->ResolveFilenameToAbsolute($parameter);
						if (@is_readable($mask_filename) && ($fp_mask = @fopen($mask_filename, 'rb'))) {
							$MaskImageData = fread($fp_mask, filesize($mask_filename));
							fclose($fp_mask);
							if ($gdimg_mask = $this->ImageCreateFromStringReplacement($MaskImageData)) {
								$this->is_alpha = true;
								phpthumb_filters::ApplyMask($gdimg_mask, $this->gdimg_output);
								ImageDestroy($gdimg_mask);
							} else {
								$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$mask_filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('Cannot open mask file "'.$mask_filename.'"', __FILE__, __LINE__);
						}
						break;

					case 'elip':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Elipse() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						$this->is_alpha = true;
						phpthumb_filters::Elipse($this->gdimg_output);
						break;

					case 'ric':
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping RoundedImageCorners() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						@list($radius_x, $radius_y) = explode('|', $parameter);
						if (($radius_x < 1) || ($radius_y < 1)) {
							$this->DebugMessage('Skipping RoundedImageCorners('.$radius_x.', '.$radius_y.') because x/y radius is less than 1', __FILE__, __LINE__);
							break;
						}
						$this->is_alpha = true;
						phpthumb_filters::RoundedImageCorners($this->gdimg_output, $radius_x, $radius_y);
						break;

					case 'bord':
						@list($border_width, $radius_x, $radius_y, $hexcolor_border) = explode('|', $parameter);
						$this->is_alpha = true;
						phpthumb_filters::ImageBorder($this->gdimg_output, $border_width, $radius_x, $radius_y, $hexcolor_border);
						break;

					case 'over':
						@list($filename, $underlay, $margin, $opacity) = explode('|', $parameter);
						$underlay = (bool) ($underlay              ? $underlay : false);
						$margin   =        ((strlen($margin)  > 0) ? $margin   : ($underlay ? 0.1 : 0.0));
						$opacity  =        ((strlen($opacity) > 0) ? $opacity  : 100);
						if (($margin > 0) && ($margin < 1)) {
							$margin = min(0.499, $margin);
						} elseif (($margin > -1) && ($margin < 0)) {
							$margin = max(-0.499, $margin);
						}

						$filename = $this->ResolveFilenameToAbsolute($filename);
						if (@is_readable($filename) && ($fp_watermark = @fopen($filename, 'rb'))) {
							$WatermarkImageData = fread($fp_watermark, filesize($filename));
							fclose($fp_watermark);
							if ($img_watermark = $this->ImageCreateFromStringReplacement($WatermarkImageData)) {
								if ($margin < 1) {
									$resized_x = max(1, ImageSX($this->gdimg_output) - round(2 * (ImageSX($this->gdimg_output) * $margin)));
									$resized_y = max(1, ImageSY($this->gdimg_output) - round(2 * (ImageSY($this->gdimg_output) * $margin)));
								} else {
									$resized_x = max(1, ImageSX($this->gdimg_output) - round(2 * $margin));
									$resized_y = max(1, ImageSY($this->gdimg_output) - round(2 * $margin));
								}

								if ($underlay) {

									if ($img_watermark_resized = phpthumb_functions::ImageCreateFunction(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output))) {
										ImageAlphaBlending($img_watermark_resized, false);
										ImageSaveAlpha($img_watermark_resized, true);
										phpthumb_functions::ImageResizeFunction($img_watermark_resized, $img_watermark, 0, 0, 0, 0, ImageSX($img_watermark_resized), ImageSY($img_watermark_resized), ImageSX($img_watermark), ImageSY($img_watermark));
										if ($img_source_resized = phpthumb_functions::ImageCreateFunction($resized_x, $resized_y)) {
											ImageAlphaBlending($img_source_resized, false);
											ImageSaveAlpha($img_source_resized, true);
											phpthumb_functions::ImageResizeFunction($img_source_resized, $this->gdimg_output, 0, 0, 0, 0, ImageSX($img_source_resized), ImageSY($img_source_resized), ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
											phpthumb_filters::WatermarkOverlay($img_watermark_resized, $img_source_resized, 'C', $opacity, $margin);
											ImageCopy($this->gdimg_output, $img_watermark_resized, 0, 0, 0, 0, ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
										} else {
											$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.$resized_x.', '.$resized_y.')', __FILE__, __LINE__);
										}
										ImageDestroy($img_watermark_resized);
									} else {
										$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.ImageSX($this->gdimg_output).', '.ImageSY($this->gdimg_output).')', __FILE__, __LINE__);
									}

								} else { // overlay

									if ($img_watermark_resized = phpthumb_functions::ImageCreateFunction($resized_x, $resized_y)) {
										ImageAlphaBlending($img_watermark_resized, false);
										ImageSaveAlpha($img_watermark_resized, true);
										phpthumb_functions::ImageResizeFunction($img_watermark_resized, $img_watermark, 0, 0, 0, 0, ImageSX($img_watermark_resized), ImageSY($img_watermark_resized), ImageSX($img_watermark), ImageSY($img_watermark));
										phpthumb_filters::WatermarkOverlay($this->gdimg_output, $img_watermark_resized, 'C', $opacity, $margin);
										ImageDestroy($img_watermark_resized);
									} else {
										$this->DebugMessage('phpthumb_functions::ImageCreateFunction('.$resized_x.', '.$resized_y.')', __FILE__, __LINE__);
									}

								}
								ImageDestroy($img_watermark);

							} else {
								$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('Cannot open overlay file "'.$filename.'"', __FILE__, __LINE__);
						}
						break;

					case 'wmi':
						@list($filename, $alignment, $opacity, $margin) = explode('|', $parameter);
						$alignment = ($alignment       ? $alignment : 'BR');
						$opacity   = (strlen($opacity) ? $opacity   : 50);
						$margin    = (strlen($margin)  ? $margin    : 5);

						$filename = $this->ResolveFilenameToAbsolute($filename);
						if (@is_readable($filename) && ($fp_watermark = @fopen($filename, 'rb'))) {
							$WatermarkImageData = fread($fp_watermark, filesize($filename));
							fclose($fp_watermark);
							if ($img_watermark = $this->ImageCreateFromStringReplacement($WatermarkImageData)) {
								// great
								phpthumb_filters::WatermarkOverlay($this->gdimg_output, $img_watermark, $alignment, $opacity, $margin);
								ImageDestroy($img_watermark);
							} else {
								$this->DebugMessage('ImageCreateFromStringReplacement() failed for "'.$filename.'"', __FILE__, __LINE__);
							}
						} else {
							$this->DebugMessage('Cannot open watermark file "'.$filename.'"', __FILE__, __LINE__);
						}
						break;

					case 'wmt':
						@list($text, $size, $alignment, $hex_color, $ttffont, $opacity, $margin, $angle) = explode('|', $parameter);
						$text      = ($text            ? $text      : '');
						$size      = ($size            ? $size      : 3);
						$alignment = ($alignment       ? $alignment : 'BR');
						$hex_color = ($hex_color       ? $hex_color : '000000');
						$ttffont   = ($ttffont         ? $ttffont   : '');
						$opacity   = (strlen($opacity) ? $opacity   : 50);
						$margin    = (strlen($margin)  ? $margin    : 5);
						$angle     = (strlen($angle)   ? $angle     : 0);

						if (basename($ttffont) == $ttffont) {
							$ttffont = realpath($this->config_ttf_directory.$this->osslash.$ttffont);
						} else {
							$ttffont = $this->ResolveFilenameToAbsolute($ttffont);
						}
						phpthumb_filters::WatermarkText($this->gdimg_output, $text, $size, $alignment, $hex_color, $ttffont, $opacity, $margin, $angle);
						break;

					case 'blur':
						@list($radius) = explode('|', $parameter);
						$radius = ($radius ? $radius : 1);
						if (phpthumb_functions::gd_version() < 2) {
							$this->DebugMessage('Skipping Blur() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						phpthumb_filters::Blur($this->gdimg_output, $radius);
						break;

					case 'gblr':
						phpthumb_filters::BlurGaussian($this->gdimg_output);
						break;

					case 'sblr':
						phpthumb_filters::BlurSelective($this->gdimg_output);
						break;

					case 'mean':
						phpthumb_filters::MeanRemoval($this->gdimg_output);
						break;

					case 'smth':
						phpthumb_filters::Smooth($this->gdimg_output, $parameter);
						break;

					case 'usm':
						@list($amount, $radius, $threshold) = explode('|', $parameter);
						$amount    = ($amount            ? $amount    : 80);
						$radius    = ($radius            ? $radius    : 0.5);
						$threshold = (strlen($threshold) ? $threshold : 3);
						if (phpthumb_functions::gd_version() >= 2.0) {
							ob_start();
							if (!@include_once(dirname(__FILE__).'/phpthumb.unsharp.php')) {
								$include_error = ob_get_contents();
								if ($include_error) {
									$this->DebugMessage('include_once("'.dirname(__FILE__).'/phpthumb.unsharp.php") generated message: "'.$include_error.'"', __FILE__, __LINE__);
								}
								ob_end_clean();
								$this->DebugMessage('Error including "'.dirname(__FILE__).'/phpthumb.unsharp.php" which is required for unsharp masking', __FILE__, __LINE__);
								return false;
							}
							ob_end_clean();
							phpUnsharpMask::applyUnsharpMask($this->gdimg_output, $amount, $radius, $threshold);
						} else {
							$this->DebugMessage('Skipping unsharp mask because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
							return false;
						}
						break;
				}
			}
		}
		return true;
	}

	function MaxFileSize() {
		if (phpthumb_functions::gd_version() < 2) {
			$this->DebugMessage('Skipping MaxFileSize() because gd_version is "'.phpthumb_functions::gd_version().'"', __FILE__, __LINE__);
			return false;
		}
		if ($this->maxb > 0) {
			switch ($this->thumbnailFormat) {
				case 'png':
				case 'gif':
					$imgRenderFunction = 'image'.$this->thumbnailFormat;

					ob_start();
					$imgRenderFunction($this->gdimg_output);
					$imgdata = ob_get_contents();
					ob_end_clean();

					if (strlen($imgdata) > $this->maxb) {
						for ($i = 8; $i >= 1; $i--) {
							$tempIMG = ImageCreateTrueColor(ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
							ImageCopy($tempIMG, $this->gdimg_output, 0, 0, 0, 0, ImageSX($this->gdimg_output), ImageSY($this->gdimg_output));
							ImageTrueColorToPalette($tempIMG, true, pow(2, $i));
							ob_start();
							$imgRenderFunction($tempIMG);
							$imgdata = ob_get_contents();
							ob_end_clean();

							if (strlen($imgdata) <= $this->maxb) {
								ImageTrueColorToPalette($this->gdimg_output, true, pow(2, $i));
								break;
							}
						}
					}
					if (strlen($imgdata) > $this->maxb) {
						ImageTrueColorToPalette($this->gdimg_output, true, pow(2, $i));
						return false;
					}
					break;

				case 'jpeg':
					ob_start();
					ImageJPEG($this->gdimg_output);
					$imgdata = ob_get_contents();
					ob_end_clean();

					$OriginalJPEGquality = $this->thumbnailQuality;
					if (strlen($imgdata) > $this->maxb) {
						for ($i = 3; $i < 20; $i++) {
							$q = round(100 * (1 - log10($i / 2)));
							ob_start();
							ImageJPEG($this->gdimg_output, '', $q);
							$imgdata = ob_get_contents();
							ob_end_clean();

							$this->thumbnailQuality = $q;
							if (strlen($imgdata) <= $this->maxb) {
								break;
							}
						}
					}
					if (strlen($imgdata) > $this->maxb) {
						return false;
					}
					break;

				default:
					return false;
					break;
			}
		}
		return true;
	}

	function CalculateThumbnailDimensions() {

		$this->thumbnailCropX = ($this->sx ? (($this->sx >= 1) ? $this->sx : round($this->sx * $this->source_width))  : 0);
		$this->thumbnailCropY = ($this->sy ? (($this->sy >= 1) ? $this->sy : round($this->sy * $this->source_height)) : 0);
		$this->thumbnailCropW = ($this->sw ? (($this->sw >= 1) ? $this->sw : round($this->sw * $this->source_width))  : $this->source_width);
		$this->thumbnailCropH = ($this->sh ? (($this->sh >= 1) ? $this->sh : round($this->sh * $this->source_height)) : $this->source_height);

		// limit source area to original image area
		$this->thumbnailCropW = max(1, min($this->thumbnailCropW, $this->source_width  - $this->thumbnailCropX));
		$this->thumbnailCropH = max(1, min($this->thumbnailCropH, $this->source_height - $this->thumbnailCropY));

		$this->DebugMessage('CalculateThumbnailDimensions() [x,y,w,h] initially set to ['.$this->thumbnailCropX.','.$this->thumbnailCropY.','.$this->thumbnailCropW.','.$this->thumbnailCropH.']', __FILE__, __LINE__);

		if ($this->zc && $this->w && $this->h) {
			// Zoom Crop
			// retain proportional resizing we did above, but crop off larger dimension so smaller
			// dimension fully fits available space

			$scaling_X = $this->source_width  / $this->w;
			$scaling_Y = $this->source_height / $this->h;
			if ($scaling_X > $scaling_Y) {
				// some of the width will need to be cropped
				$allowable_width = $this->source_width / $scaling_X * $scaling_Y;
				$this->thumbnailCropW = round($allowable_width);
				$this->thumbnailCropX = round(($this->source_width - $allowable_width) / 2);

			} elseif ($scaling_Y > $scaling_X) {
				// some of the height will need to be cropped
				$allowable_height = $this->source_height / $scaling_Y * $scaling_X;
				$this->thumbnailCropH = round($allowable_height);
				$this->thumbnailCropY = round(($this->source_height - $allowable_height) / 2);

			} else {
				// image fits perfectly, no cropping needed
			}
			$this->thumbnail_width  = $this->w;
			$this->thumbnail_height = $this->h;
			$this->thumbnail_image_width  = $this->thumbnail_width;
			$this->thumbnail_image_height = $this->thumbnail_height;

		} elseif ($this->iar && $this->w && $this->h) {

			// Ignore Aspect Ratio
			// stretch image to fit exactly 'w' x 'h'
			$this->thumbnail_width  = $this->w;
			$this->thumbnail_height = $this->h;
			$this->thumbnail_image_width  = $this->thumbnail_width;
			$this->thumbnail_image_height = $this->thumbnail_height;

		} else {

			$original_aspect_ratio = $this->thumbnailCropW / $this->thumbnailCropH;
			if ($this->aoe) {
				$maxwidth  = max($this->w, $this->thumbnailCropW);
				$maxheight = max($this->h, $this->thumbnailCropH);
				$maxwidth  = max($maxwidth, $maxheight * $original_aspect_ratio);
				$maxheight = max($maxheight, $maxwidth / $original_aspect_ratio);
			} else {
				$maxwidth  = phpthumb_functions::nonempty_min($this->w, $this->thumbnailCropW, $this->config_output_maxwidth);
				$maxheight = phpthumb_functions::nonempty_min($this->h, $this->thumbnailCropH, $this->config_output_maxheight);
				$maxwidth  = min($maxwidth, $maxheight * $original_aspect_ratio);
				$maxheight = min($maxheight, $maxwidth / $original_aspect_ratio);
			}

			$this->thumbnail_image_width  = $maxwidth;
			$this->thumbnail_image_height = $maxheight;
			$this->thumbnail_width  = $maxwidth;
			$this->thumbnail_height = $maxheight;

			$this->FixedAspectRatio();
		}

		$this->thumbnail_width  = max(1, floor($this->thumbnail_width));
		$this->thumbnail_height = max(1, floor($this->thumbnail_height));
		return true;
	}

	function CreateGDoutput() {

		$this->CalculateThumbnailDimensions();

		// Create the GD image (either true-color or 256-color, depending on GD version)
		$this->gdimg_output = phpthumb_functions::ImageCreateFunction($this->thumbnail_width, $this->thumbnail_height);

		// Images that have transparency must have the background filled with the configured 'bg' color
		// otherwise the transparent color will appear as black
		if (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.2', '>=')) {
			ImageSaveAlpha($this->gdimg_output, true);
		}
		if ($this->is_alpha && phpthumb_functions::gd_version() >= 2) {

			ImageAlphaBlending($this->gdimg_output, false);
			$output_full_alpha = phpthumb_functions::ImageColorAllocateAlphaSafe($this->gdimg_output, 255, 255, 255, 127);
			ImageFilledRectangle($this->gdimg_output, 0, 0, $this->thumbnail_width, $this->thumbnail_height, $output_full_alpha);

		} else {

			$current_transparent_color = ImageColorTransparent($this->gdimg_source);
			if ($this->bg || (@$current_transparent_color >= 0)) {

				$this->config_background_hexcolor = ($this->bg ? $this->bg : $this->config_background_hexcolor);
				if (!phpthumb_functions::IsHexColor($this->config_background_hexcolor)) {
					return $this->ErrorImage('Invalid hex color string "'.$this->config_background_hexcolor.'" for parameter "bg"');
				}
				$background_color = phpthumb_functions::ImageHexColorAllocate($this->gdimg_output, $this->config_background_hexcolor);
				ImageFilledRectangle($this->gdimg_output, 0, 0, $this->thumbnail_width, $this->thumbnail_height, $background_color);

			}

		}
		return true;
	}

	function SetOrientationDependantWidthHeight() {
		if ($this->source_height > $this->source_width) {
			// portrait
			$this->w = ($this->wp ? $this->wp : $this->w);
			$this->h = ($this->hp ? $this->hp : $this->h);
		} elseif ($this->source_height < $this->source_width) {
			// landscape
			$this->w = ($this->wl ? $this->wl : $this->w);
			$this->h = ($this->hl ? $this->hl : $this->h);
		} else {
			// square
			$this->w = ($this->ws ? $this->ws : $this->w);
			$this->h = ($this->hs ? $this->hs : $this->h);
		}
		//$this->w = ($this->w ? $this->w : ($this->wl ? $this->wl : ($this->wp ? $this->wp : ($this->ws ? $this->ws : $this->source_width))));
		//$this->h = ($this->h ? $this->h : ($this->hl ? $this->hl : ($this->hp ? $this->hp : ($this->hs ? $this->hs : $this->source_height))));
		return true;
	}

	function ExtractEXIFgetImageSize() {

		if (is_resource($this->gdimg_source)) {

			$this->source_width  = ImageSX($this->gdimg_source);
			$this->source_height = ImageSY($this->gdimg_source);

			$this->SetOrientationDependantWidthHeight();

		} elseif ($this->rawImageData && !$this->sourceFilename) {

			$this->DebugMessage('bypassing EXIF and GetImageSize sections because $this->rawImageData is set and $this->sourceFilename is not set', __FILE__, __LINE__);

		}

		if ($this->getimagesizeinfo = @GetImageSize($this->sourceFilename)) {
			// great
		} else {
			$this->DebugMessage('GetImageSize("'.$this->sourceFilename.'") failed', __FILE__, __LINE__);
		}

		if ($this->config_prefer_imagemagick) {
			if ($this->ImageMagickThumbnailToGD()) {
				return true;
			}
			$this->DebugMessage('ImageMagickThumbnailToGD() failed', __FILE__, __LINE__);
		}

		$this->source_width  = $this->getimagesizeinfo[0];
		$this->source_height = $this->getimagesizeinfo[1];

		$this->SetOrientationDependantWidthHeight();

		if (function_exists('exif_thumbnail') && ($this->getimagesizeinfo[2] == 2)) {
			// Extract EXIF info from JPEGs

			$this->exif_thumbnail_width  = '';
			$this->exif_thumbnail_height = '';
			$this->exif_thumbnail_type   = '';

			// The parameters width, height and imagetype are available since PHP v4.3.0
			if (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.0', '>=')) {

				$this->exif_thumbnail_data = @exif_thumbnail($this->sourceFilename, $this->exif_thumbnail_width, $this->exif_thumbnail_height, $this->exif_thumbnail_type);

			} else {

				// older versions of exif_thumbnail output an error message but NOT return false on failure
				ob_start();
				$this->exif_thumbnail_data = exif_thumbnail($this->sourceFilename);
				$exit_thumbnail_error = ob_get_contents();
				ob_end_clean();
				if (!$exit_thumbnail_error && $this->exif_thumbnail_data) {

					if ($gdimg_exif_temp = $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data, false)) {
						$this->exif_thumbnail_width  = ImageSX($gdimg_exif_temp);
						$this->exif_thumbnail_height = ImageSY($gdimg_exif_temp);
						$this->exif_thumbnail_type   = 2; // (2 == JPEG) before PHP v4.3.0 only JPEG format EXIF thumbnails are returned
						unset($gdimg_exif_temp);
					} else {
						return $this->ErrorImage('Failed - $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data) in '.__FILE__.' on line '.__LINE__);
					}

				}

			}

		} elseif (!function_exists('exif_thumbnail')) {

			$this->DebugMessage('exif_thumbnail() does not exist, cannot extract EXIF thumbnail', __FILE__, __LINE__);
			return false;

		}

		$this->DebugMessage('EXIF thumbnail extraction: (size='.strlen($this->exif_thumbnail_data).'; type='.$this->exif_thumbnail_type.'; '.$this->exif_thumbnail_width.'x'.$this->exif_thumbnail_height.')', __FILE__, __LINE__);

		// see if EXIF thumbnail can be used directly with no processing
		if ($this->config_use_exif_thumbnail_for_speed && $this->exif_thumbnail_data) {
			while (true) {
				if (!$this->xto) {
					$source_ar = $this->source_width / $this->source_height;
					$exif_ar = $this->exif_thumbnail_width / $this->exif_thumbnail_height;
					if (number_format($source_ar, 2) != number_format($exif_ar, 2)) {
						$this->DebugMessage('not using EXIF thumbnail because $source_ar != $exif_ar ('.$source_ar.' != '.$exif_ar.')', __FILE__, __LINE__);
						break;
					}
					if ($this->w && ($this->w != $this->exif_thumbnail_width)) {
						$this->DebugMessage('not using EXIF thumbnail because $this->w != $this->exif_thumbnail_width ('.$this->w.' != '.$this->exif_thumbnail_width.')', __FILE__, __LINE__);
						break;
					}
					if ($this->h && ($this->h != $this->exif_thumbnail_height)) {
						$this->DebugMessage('not using EXIF thumbnail because $this->h != $this->exif_thumbnail_height ('.$this->h.' != '.$this->exif_thumbnail_height.')', __FILE__, __LINE__);
						break;
					}
					$CannotBeSetParameters = array('sx', 'sy', 'sh', 'sw', 'far', 'bg', 'bc', 'fltr', 'phpThumbDebug');
					foreach ($CannotBeSetParameters as $parameter) {
						if ($this->$parameter) {
							break 2;
						}
					}
				}

				$this->DebugMessage('setting $this->gdimg_source = $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data)', __FILE__, __LINE__);
				$this->gdimg_source = $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data);
				$this->source_width  = ImageSX($this->gdimg_source);
				$this->source_height = ImageSY($this->gdimg_source);
				return true;
			}
		}

		if (($this->config_max_source_pixels > 0) && (($this->source_width * $this->source_height) > $this->config_max_source_pixels)) {

			// Source image is larger than would fit in available PHP memory.
			// If ImageMagick is installed, use it to generate the thumbnail.
			// Else, if an EXIF thumbnail is available, use that as the source image.
			// Otherwise, no choice but to fail with an error message
			$this->DebugMessage('image is '.$this->source_width.'x'.$this->source_height.' and therefore contains more pixels ('.($this->source_width * $this->source_height).') than $this->config_max_source_pixels setting ('.$this->config_max_source_pixels.')', __FILE__, __LINE__);
			if (!$this->config_prefer_imagemagick && $this->ImageMagickThumbnailToGD()) {
				// excellent, we have a thumbnailed source image
				return true;
			}

		}
		return true;
	}

	function SetCacheFilename() {
		if (!is_null($this->cache_filename)) {
			$this->DebugMessage('$this->cache_filename already set, skipping SetCacheFilename()', __FILE__, __LINE__);
			return true;
		}
		$this->setOutputFormat();
		$this->setCacheDirectory();
		if (!$this->config_cache_directory) {
			$this->DebugMessage('SetCacheFilename() failed because $this->config_cache_directory is empty', __FILE__, __LINE__);
			return false;
		}

		if (!$this->sourceFilename && !$this->rawImageData && $this->src) {
			$this->sourceFilename = $this->ResolveFilenameToAbsolute($this->src);
		}

		if ($this->config_cache_default_only_suffix && $this->sourceFilename) {
			// simplified cache filenames:
			// only use default parameters in phpThumb.config.php
			// substitute source filename into * in $this->config_cache_default_only_suffix
			// (eg: '*_thumb' becomes 'picture_thumb.jpg')
			if (strpos($this->config_cache_default_only_suffix, '*') === false) {
				$this->DebugMessage('aborting simplified caching filename because no * in "'.$this->config_cache_default_only_suffix.'"', __FILE__, __LINE__);
			} else {
				preg_match('/(.+)(\.[a-z0-9]+)?$/iU', basename($this->sourceFilename), $matches);
				$this->cache_filename = $this->config_cache_directory.$this->osslash.str_replace('*', $matches[1], $this->config_cache_default_only_suffix).'.'.strtolower($this->thumbnailFormat);
				return true;
			}
		}

		$this->cache_filename = $this->config_cache_directory.$this->osslash.'phpThumb_cache_'.@$_SERVER['SERVER_NAME'];
		if ($this->new) {
			$this->cache_filename .= '_new'.strtolower(md5($this->new));
		} elseif ($this->md5s) {
			// source image MD5 hash provided
			$this->cache_filename .= '_raw'.$this->md5s;
		} elseif (!$this->src && $this->rawImageData) {
			$this->cache_filename .= '_raw'.strtolower(md5($this->rawImageData));
		} else {
			$this->cache_filename .= '_src'.strtolower(md5($this->sourceFilename));
		}
		if (@$_SERVER['HTTP_REFERER'] && $this->config_cache_differentiate_offsite) {
			$parsed_url1 = @parse_url(@$_SERVER['HTTP_REFERER']);
			$parsed_url2 = @parse_url('http://'.@$_SERVER['HTTP_HOST']);
			if (@$parsed_url1['host'] && @$parsed_url2['host'] && ($parsed_url1['host'] != $parsed_url2['host'])) {
				// include refering domain only if it doesn't match the domain of the current server
				//$this->cache_filename .= '_ref'.strtolower(md5(@$parsed_url2['host']));
				$this->cache_filename .= '_offsite';
			}
		}

		$ParametersString = '';
		if ($this->fltr && is_array($this->fltr)) {
			$ParametersString .= '_fltr'.implode('_fltr', $this->fltr);
		}
		$FilenameParameters1 = array('ar', 'bg', 'bc', 'far');
		foreach ($FilenameParameters1 as $key) {
			if ($this->$key) {
				$ParametersString .= '_'.$key.$this->$key;
			}
		}
		$FilenameParameters2 = array('h', 'w', 'wl', 'wp', 'ws', 'hp', 'hs', 'sx', 'sy', 'sw', 'sh', 'xto', 'ra', 'iar', 'aoe', 'maxb');
		foreach ($FilenameParameters2 as $key) {
			if ($this->$key) {
				$ParametersString .= '_'.$key.intval($this->$key);
			}
		}
		if ($this->thumbnailFormat == 'jpeg') {
			// only JPEG output has variable quality option
			$ParametersString .= '_q'.intval($this->thumbnailQuality);
		}
		$this->DebugMessage('SetCacheFilename() _par set from md5('.$ParametersString.')', __FILE__, __LINE__);
		$this->cache_filename .= '_par'.strtolower(md5($ParametersString));

		if ($this->md5s) {
			// source image MD5 hash provided
			// do not source image modification date --
			// cached image will be used even if file was modified or removed
		} elseif (!$this->config_cache_source_filemtime_ignore_remote && eregi('^(f|ht)tps?://', $this->src)) {
			$this->cache_filename .= '_dat'.intval(phpthumb_functions::filedate_remote($this->src));
		} elseif (!$this->config_cache_source_filemtime_ignore_local && $this->src && !$this->rawImageData) {
			$this->cache_filename .= '_dat'.intval(@filemtime($this->sourceFilename));
		}

		$this->cache_filename .= '.'.strtolower($this->thumbnailFormat);

		return true;
	}

	function SourceImageToGD() {
		if (is_resource($this->gdimg_source)) {
			$this->DebugMessage('skipping SourceImageToGD() because $this->gdimg_source is already a resource', __FILE__, __LINE__);
			return true;
		}
		$this->DebugMessage('starting SourceImageToGD()', __FILE__, __LINE__);
		while (true) {
			if (!$this->config_use_exif_thumbnail_for_speed) {
				$this->DebugMessage('Not using EXIF thumbnail data because $this->config_use_exif_thumbnail_for_speed is FALSE', __FILE__, __LINE__);
				break;
			}
			if (!$this->exif_thumbnail_data) {
				$this->DebugMessage('Not using EXIF thumbnail data because $this->exif_thumbnail_data is empty', __FILE__, __LINE__);
				break;
			}
			if (($this->thumbnailCropX != 0) || ($this->thumbnailCropY != 0)) {
				$this->DebugMessage('Not using EXIF thumbnail data because source cropping is enabled ('.$this->thumbnailCropX.','.$this->thumbnailCropY.')', __FILE__, __LINE__);
				break;
			}
			if (($this->w > $this->exif_thumbnail_width) || ($this->h > $this->exif_thumbnail_height)) {
				$this->DebugMessage('Not using EXIF thumbnail data because EXIF thumbnail is too small ('.$this->exif_thumbnail_width.'x'.$this->exif_thumbnail_height.' vs '.$this->w.'x'.$this->h.')', __FILE__, __LINE__);
				break;
			}
			$source_ar = $this->source_width / $this->source_height;
			$exif_ar = $this->exif_thumbnail_width / $this->exif_thumbnail_height;
			if (number_format($source_ar, 2) != number_format($exif_ar, 2)) {
				$this->DebugMessage('not using EXIF thumbnail because $source_ar != $exif_ar ('.$source_ar.' != '.$exif_ar.')', __FILE__, __LINE__);
			}

			// EXIF thumbnail exists, and is equal to or larger than destination thumbnail, and will be use as source image
			$this->DebugMessage('Trying to use EXIF thumbnail as source image', __FILE__, __LINE__);

			if ($gdimg_exif_temp = $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data, false)) {

				$this->DebugMessage('Successfully using EXIF thumbnail as source image', __FILE__, __LINE__);

				$this->gdimg_source   = $gdimg_exif_temp;
				$this->source_width   = $this->exif_thumbnail_width;
				$this->source_height  = $this->exif_thumbnail_height;
				$this->thumbnailCropW = $this->source_width;
				$this->thumbnailCropH = $this->source_height;
				return true;

			} else {
				$this->DebugMessage('$this->ImageCreateFromStringReplacement($this->exif_thumbnail_data, false) failed', __FILE__, __LINE__);
			}

			break;
		}
		if (!$this->gdimg_source) {
			// try to create GD image source directly via GD, if possible,
			// rather than buffering to memory and creating with ImageCreateFromString
			$ImageCreateWasAttempted = false;

			$ImageCreateFromFunction = array(
				1  => 'ImageCreateFromGIF',
				2  => 'ImageCreateFromJPEG',
				3  => 'ImageCreateFromPNG',
				15 => 'ImageCreateFromWBMP',
			);
			switch (@$this->getimagesizeinfo[2]) {
				case 1:  // GIF
				case 2:  // JPEG
				case 3:  // PNG
				case 15: // WBMP
					if ($this->md5s && ($this->md5s != phpthumb_functions::md5_file_safe($this->sourceFilename))) {
						return $this->ErrorImage('$this->md5s != md5($this->rawImageData)'."\n".'"'.$this->md5s.'" != '."\n".'"'.phpthumb_functions::md5_file_safe($this->sourceFilename).'"');
					}
					$ImageCreateFromFunctionName = $ImageCreateFromFunction[$this->getimagesizeinfo[2]];
					if (function_exists($ImageCreateFromFunctionName)) {
						$this->DebugMessage('Calling '.$ImageCreateFromFunctionName.'('.$this->sourceFilename.')', __FILE__, __LINE__);
						$ImageCreateWasAttempted = true;
						$this->gdimg_source = @$ImageCreateFromFunctionName($this->sourceFilename);
						switch ($this->getimagesizeinfo[2]) {
							case 1:
							case 3:
								// GIF or PNG input file may have transparency
								$this->is_alpha = true;
								break;
						}
					} else {
						$this->DebugMessage('NOT calling '.$ImageCreateFromFunctionName.'('.$this->sourceFilename.') because !function_exists('.$ImageCreateFromFunctionName.')', __FILE__, __LINE__);
					}
					break;

				case 4:  // SWF
				case 5:  // PSD
				case 6:  // BMP
				case 7:  // TIFF (LE)
				case 8:  // TIFF (BE)
				case 9:  // JPC
				case 10: // JP2
				case 11: // JPX
				case 12: // JB2
				case 13: // SWC
				case 14: // IFF
				case 16: // XBM
					$this->DebugMessage('No built-in image creation function for image type "'.@$this->getimagesizeinfo[2].'" ($this->getimagesizeinfo[2])', __FILE__, __LINE__);
					break;

				case '':
					// no source file, source image was probably set by setSourceData()
					break;

				default:
					$this->DebugMessage('Unknown value for $this->getimagesizeinfo[2]: "'.@$this->getimagesizeinfo[2].'"', __FILE__, __LINE__);
					break;
			}
			if (!$this->gdimg_source) {
				// cannot create from filename, attempt to create source image with ImageCreateFromString, if possible
				if ($ImageCreateWasAttempted) {
					$this->DebugMessage(@$ImageCreateFromFunctionName.'() was attempted but FAILED', __FILE__, __LINE__);
				}
				if (!$this->rawImageData) {
					$this->DebugMessage('Populating $this->rawImageData and attempting ImageCreateFromStringReplacement()', __FILE__, __LINE__);
					if ($fp = @fopen($this->sourceFilename, 'rb')) {

						$this->rawImageData = '';
						$filesize = filesize($this->sourceFilename);
						$blocksize = 16384;
						$blockreads = ceil($filesize / $blocksize);
						for ($i = 0; $i < $blockreads; $i++) {
							$this->rawImageData .= fread($fp, $blocksize);
						}
						fclose($fp);

					} else {
						return $this->ErrorImage('cannot fopen("'.$this->sourceFilename.'") on line '.__LINE__.' of '.__FILE__);
					}
				}
				if ($this->md5s && ($this->md5s != md5($this->rawImageData))) {
					return $this->ErrorImage('$this->md5s != md5($this->rawImageData)'."\n".'"'.$this->md5s.'" != '."\n".'"'.md5($this->rawImageData).'"');
				}
				$this->gdimg_source = $this->ImageCreateFromStringReplacement($this->rawImageData, true);
			}

			if (!$this->gdimg_source) {
				$this->DebugMessage('$this->gdimg_source is still empty', __FILE__, __LINE__);

				if ($this->ImageMagickThumbnailToGD()) {

					// excellent, we have a thumbnailed source image
					$this->DebugMessage('ImageMagickThumbnailToGD() succeeded', __FILE__, __LINE__);

				} else {

					$this->DebugMessage('ImageMagickThumbnailToGD() failed', __FILE__, __LINE__);

					$imageHeader = '';
					$gd_info = phpthumb_functions::gd_info();
					$GDreadSupport = false;
					switch (substr($this->rawImageData, 0, 3)) {
						case 'GIF':
							$imageHeader = 'Content-Type: image/gif';
							$GDreadSupport = (bool) @$gd_info['GIF Read Support'];
							break;
						case "\xFF\xD8\xFF":
							$imageHeader = 'Content-Type: image/jpeg';
							$GDreadSupport = (bool) @$gd_info['JPG Support'];
							break;
						case "\x89".'PN':
							$imageHeader = 'Content-Type: image/png';
							$GDreadSupport = (bool) @$gd_info['PNG Support'];
							break;
					}
					if ($imageHeader) {
						// cannot create image for whatever reason (maybe ImageCreateFromJPEG et al are not available?)
						// and ImageMagick is not available either, no choice but to output original (not resized/modified) data and exit
						if ($this->config_error_die_on_source_failure && !$this->phpThumbDebug) {
							$this->ErrorImage('All attempts to create GD image source failed ('.($GDreadSupport ? 'source image probably corrupt' : 'GD does not have read support for "'.$imageHeader.'"').'), cannot generate thumbnail');
						} else {
							//$this->DebugMessage('All attempts to create GD image source failed ('.($GDreadSupport ? 'source image probably corrupt' : 'GD does not have read support for "'.$imageHeader.'"').'), outputing raw image', __FILE__, __LINE__);
							//if (!$this->phpThumbDebug) {
							//	header($imageHeader);
							//	echo $this->rawImageData;
							//	exit;
							//}
							return false;
						}
					}

					switch (substr($this->rawImageData, 0, 2)) {
						case 'BM':
							ob_start();
							if (!@include_once(dirname(__FILE__).'/phpthumb.bmp.php')) {
								ob_end_clean();
								if ($this->phpThumbDebug) {
									$this->DebugMessage('include_once('.dirname(__FILE__).'/phpthumb.bmp.php) failed', __FILE__, __LINE__);
									return false;
								}
								return $this->ErrorImage('include_once('.dirname(__FILE__).'/phpthumb.bmp.php) failed');
							}
							ob_end_clean();
							$phpthumb_bmp = new phpthumb_bmp();
							if ($this->gdimg_source = $phpthumb_bmp->phpthumb_bmp2gd($this->rawImageData, (phpthumb_functions::gd_version() >= 2.0))) {
								$this->DebugMessage('$phpthumb_bmp->phpthumb_bmp2gd() succeeded', __FILE__, __LINE__);
								break;
							} elseif ($this->phpThumbDebug) {
								$this->DebugMessage('phpthumb_bmp2db failed', __FILE__, __LINE__);
								return false;
							}
							return $this->ErrorImage('ImageMagick is unavailable and phpThumb() does not support BMP source images without it');
							break;
					}

					switch (substr($this->rawImageData, 0, 4)) {
						case 'II'."\x2A\x00":
						case 'MM'."\x00\x2A":
							if ($this->phpThumbDebug) {
								$this->DebugMessage('ImageMagick is unavailable and phpThumb() does not support TIFF source images without it', __FILE__, __LINE__);
								return false;
							}
							return $this->ErrorImage('ImageMagick is unavailable and phpThumb() does not support TIFF source images without it');
							break;

						case "\xD7\xCD\xC6\x9A":
							if ($this->phpThumbDebug) {
								$this->DebugMessage('ImageMagick is unavailable and phpThumb() does not support WMF source images without it', __FILE__, __LINE__);
								return false;
							}
							return $this->ErrorImage('ImageMagick is unavailable and phpThumb() does not support WMF source images without it');
							break;
					}

					if (!$this->gdimg_source) {
						if ($this->phpThumbDebug) {
							$this->DebugMessage('Unknown image type identified by "'.substr($this->rawImageData, 0, 4).'" ('.phpthumb_functions::HexCharDisplay(substr($this->rawImageData, 0, 4)).') in SourceImageToGD()', __FILE__, __LINE__);
							return false;
						}
						return $this->ErrorImage('Unknown image type identified by "'.substr($this->rawImageData, 0, 4).'" ('.phpthumb_functions::HexCharDisplay(substr($this->rawImageData, 0, 4)).') in SourceImageToGD()');
					}

				}
			}

		}
		if (!$this->gdimg_source) {
			if ($gdimg_exif_temp = $this->ImageCreateFromStringReplacement($this->exif_thumbnail_data, false)) {
				$this->DebugMessage('All other attempts failed, but successfully using EXIF thumbnail as source image', __FILE__, __LINE__);
				$this->gdimg_source   = $gdimg_exif_temp;
				// override allow-enlarging setting if EXIF thumbnail is the only source available
				// otherwise thumbnails larger than the EXIF thumbnail will be created at EXIF size
				$this->aoe = true;
				return true;
			}
			return false;
		}
		$this->source_width  = ImageSX($this->gdimg_source);
		$this->source_height = ImageSY($this->gdimg_source);
		return true;
	}

	function phpThumbDebugVarDump($var) {
		if (is_null($var)) {
			return 'NULL';
		} elseif (is_bool($var)) {
			return ($var ? 'TRUE' : 'FALSE');
		} elseif (is_string($var)) {
			return 'string('.strlen($var).')'.str_repeat(' ', max(0, 3 - strlen(strlen($var)))).' "'.$var.'"';
		} elseif (is_int($var)) {
			return 'integer     '.$var;
		} elseif (is_float($var)) {
			return 'float       '.$var;
		} elseif (is_array($var)) {
			ob_start();
			var_dump($var);
			$vardumpoutput = ob_get_contents();
			ob_end_clean();
			return strtr($vardumpoutput, "\n\r\t", '   ');
		}
		return gettype($var);
	}

	function phpThumbDebug() {
		if ($this->config_disable_debug) {
			return $this->ErrorImage('phpThumbDebug disabled');
		}

		$FunctionsExistance = array('exif_thumbnail', 'gd_info', 'image_type_to_mime_type', 'ImageCopyResampled', 'ImageCopyResized', 'ImageCreate', 'ImageCreateFromString', 'ImageCreateTrueColor', 'ImageIsTrueColor', 'ImageRotate', 'ImageTypes', 'version_compare', 'ImageCreateFromGIF', 'ImageCreateFromJPEG', 'ImageCreateFromPNG', 'ImageCreateFromWBMP', 'ImageCreateFromXBM', 'ImageCreateFromXPM', 'ImageCreateFromString', 'ImageCreateFromGD', 'ImageCreateFromGD2', 'ImageCreateFromGD2Part', 'ImageJPEG', 'ImageGIF', 'ImagePNG', 'ImageWBMP');
		$ParameterNames     = array('src', 'new', 'w', 'h', 'f', 'q', 'sx', 'sy', 'sw', 'sh', 'far', 'bg', 'bc', 'file', 'goto', 'err', 'xto', 'ra', 'ar', 'aoe', 'iar', 'maxb');
		$OtherVariableNames = array('phpThumbDebug', 'thumbnailQuality', 'thumbnailFormat', 'gdimg_output', 'gdimg_source', 'sourceFilename', 'source_width', 'source_height', 'thumbnailCropX', 'thumbnailCropY', 'thumbnailCropW', 'thumbnailCropH', 'exif_thumbnail_width', 'exif_thumbnail_height', 'exif_thumbnail_type', 'thumbnail_width', 'thumbnail_height', 'thumbnail_image_width', 'thumbnail_image_height');

		$DebugOutput = array();
		$DebugOutput[] = 'phpThumb() version          = '.$this->phpthumb_version;
		$DebugOutput[] = 'phpversion()                = '.@phpversion();
		$DebugOutput[] = 'PHP_OS                      = '.PHP_OS;
		$DebugOutput[] = '__FILE__                    = '.__FILE__;
		$DebugOutput[] = 'realpath(.)                 = '.@realpath('.');
		$DebugOutput[] = '$_SERVER[PHP_SELF]          = '.@$_SERVER['PHP_SELF'];
		$DebugOutput[] = '$_SERVER[HTTP_REFERER]      = '.@$_SERVER['HTTP_REFERER'];
		$DebugOutput[] = '$_SERVER[QUERY_STRING]      = '.@$_SERVER['QUERY_STRING'];
		$DebugOutput[] = '$_SERVER[PATH_INFO]         = '.@$_SERVER['PATH_INFO'];
		$DebugOutput[] = '$_SERVER[DOCUMENT_ROOT]     = '.@$_SERVER['DOCUMENT_ROOT'];
		$DebugOutput[] = 'getenv(DOCUMENT_ROOT)       = '.@getenv('DOCUMENT_ROOT');
		$DebugOutput[] = '';

		$DebugOutput[] = 'get_magic_quotes_gpc()      = '.$this->phpThumbDebugVarDump(@get_magic_quotes_gpc());
		$DebugOutput[] = 'get_magic_quotes_runtime()  = '.$this->phpThumbDebugVarDump(@get_magic_quotes_runtime());
		$DebugOutput[] = 'error_reporting()           = '.$this->phpThumbDebugVarDump(error_reporting());
		$DebugOutput[] = 'ini_get(error_reporting)    = '.$this->phpThumbDebugVarDump(@ini_get('error_reporting'));
		$DebugOutput[] = 'ini_get(display_errors)     = '.$this->phpThumbDebugVarDump(@ini_get('display_errors'));
		$DebugOutput[] = 'ini_get(allow_url_fopen)    = '.$this->phpThumbDebugVarDump(@ini_get('allow_url_fopen'));
		$DebugOutput[] = 'ini_get(disable_functions)  = '.$this->phpThumbDebugVarDump(@ini_get('disable_functions'));
		$DebugOutput[] = 'ini_get(safe_mode)          = '.$this->phpThumbDebugVarDump(@ini_get('safe_mode'));
		$DebugOutput[] = 'ini_get(open_basedir)       = '.$this->phpThumbDebugVarDump(@ini_get('open_basedir'));
		$DebugOutput[] = 'ini_get(memory_limit)       = '.$this->phpThumbDebugVarDump(@ini_get('memory_limit'));
		$DebugOutput[] = 'ini_get(max_execution_time) = '.$this->phpThumbDebugVarDump(@ini_get('max_execution_time'));
		$DebugOutput[] = 'get_cfg_var(memory_limit)   = '.$this->phpThumbDebugVarDump(@get_cfg_var('memory_limit'));
		$DebugOutput[] = 'memory_get_usage()          = '.(function_exists('memory_get_usage') ? $this->phpThumbDebugVarDump(@memory_get_usage()) : 'n/a');
		$DebugOutput[] = '';

		$DebugOutput[] = '$this->config_prefer_imagemagick            = '.$this->phpThumbDebugVarDump($this->config_prefer_imagemagick);
		$DebugOutput[] = '$this->config_imagemagick_path              = '.$this->phpThumbDebugVarDump($this->config_imagemagick_path);
		$DebugOutput[] = 'SafeExec(which convert)                     = '.trim(phpthumb_functions::SafeExec('which convert'));
		$IMpathUsed = ($this->config_imagemagick_path ? $this->config_imagemagick_path : trim(phpthumb_functions::SafeExec('which convert')));
		$DebugOutput[] = '[actual ImageMagick path used]              = '.$this->phpThumbDebugVarDump($IMpathUsed);
		$DebugOutput[] = 'file_exists([actual ImageMagick path used]) = '.$this->phpThumbDebugVarDump(file_exists($IMpathUsed));
		$DebugOutput[] = 'ImageMagickVersion()                        = '.$this->ImageMagickVersion();
		$DebugOutput[] = '';

		$DebugOutput[] = '$this->config_cache_directory               = '.$this->phpThumbDebugVarDump($this->config_cache_directory);
		$DebugOutput[] = '$this->config_cache_disable_warning         = '.$this->phpThumbDebugVarDump($this->config_cache_disable_warning);
		$DebugOutput[] = '$this->config_cache_maxage                  = '.$this->phpThumbDebugVarDump($this->config_cache_maxage);
		$DebugOutput[] = '$this->config_cache_maxsize                 = '.$this->phpThumbDebugVarDump($this->config_cache_maxsize);
		$DebugOutput[] = '$this->config_cache_maxfiles                = '.$this->phpThumbDebugVarDump($this->config_cache_maxfiles);
		$DebugOutput[] = '$this->cache_filename                       = '.$this->phpThumbDebugVarDump($this->cache_filename);
		$DebugOutput[] = 'is_readable($this->config_cache_directory)  = '.$this->phpThumbDebugVarDump(is_readable($this->config_cache_directory));
		$DebugOutput[] = 'is_writable($this->config_cache_directory)  = '.$this->phpThumbDebugVarDump(is_writable($this->config_cache_directory));
		$DebugOutput[] = 'is_readable($this->cache_filename)          = '.$this->phpThumbDebugVarDump(is_readable($this->cache_filename));
		$DebugOutput[] = 'is_writable($this->cache_filename)          = '.(file_exists($this->cache_filename) ? $this->phpThumbDebugVarDump(is_writable($this->cache_filename)) : 'n/a');
		$DebugOutput[] = '';

		$DebugOutput[] = '$this->config_document_root                 = '.$this->phpThumbDebugVarDump($this->config_document_root);
		$DebugOutput[] = '$this->config_temp_directory                = '.$this->phpThumbDebugVarDump($this->config_temp_directory);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_output_format                 = '.$this->phpThumbDebugVarDump($this->config_output_format);
		$DebugOutput[] = '$this->config_output_maxwidth               = '.$this->phpThumbDebugVarDump($this->config_output_maxwidth);
		$DebugOutput[] = '$this->config_output_maxheight              = '.$this->phpThumbDebugVarDump($this->config_output_maxheight);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_error_message_image_default   = '.$this->phpThumbDebugVarDump($this->config_error_message_image_default);
		$DebugOutput[] = '$this->config_error_bgcolor                 = '.$this->phpThumbDebugVarDump($this->config_error_bgcolor);
		$DebugOutput[] = '$this->config_error_textcolor               = '.$this->phpThumbDebugVarDump($this->config_error_textcolor);
		$DebugOutput[] = '$this->config_error_fontsize                = '.$this->phpThumbDebugVarDump($this->config_error_fontsize);
		$DebugOutput[] = '$this->config_error_die_on_error            = '.$this->phpThumbDebugVarDump($this->config_error_die_on_error);
		$DebugOutput[] = '$this->config_error_silent_die_on_error     = '.$this->phpThumbDebugVarDump($this->config_error_silent_die_on_error);
		$DebugOutput[] = '$this->config_error_die_on_source_failure   = '.$this->phpThumbDebugVarDump($this->config_error_die_on_source_failure);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_nohotlink_enabled             = '.$this->phpThumbDebugVarDump($this->config_nohotlink_enabled);
		$DebugOutput[] = '$this->config_nohotlink_valid_domains       = '.$this->phpThumbDebugVarDump($this->config_nohotlink_valid_domains);
		$DebugOutput[] = '$this->config_nohotlink_erase_image         = '.$this->phpThumbDebugVarDump($this->config_nohotlink_erase_image);
		$DebugOutput[] = '$this->config_nohotlink_text_message        = '.$this->phpThumbDebugVarDump($this->config_nohotlink_text_message);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_nooffsitelink_enabled         = '.$this->phpThumbDebugVarDump($this->config_nooffsitelink_enabled);
		$DebugOutput[] = '$this->config_nooffsitelink_valid_domains   = '.$this->phpThumbDebugVarDump($this->config_nooffsitelink_valid_domains);
		$DebugOutput[] = '$this->config_nooffsitelink_require_refer   = '.$this->phpThumbDebugVarDump($this->config_nooffsitelink_require_refer);
		$DebugOutput[] = '$this->config_nooffsitelink_erase_image     = '.$this->phpThumbDebugVarDump($this->config_nooffsitelink_erase_image);
		$DebugOutput[] = '$this->config_nooffsitelink_text_message    = '.$this->phpThumbDebugVarDump($this->config_nooffsitelink_text_message);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_high_security_enabled         = '.$this->phpThumbDebugVarDump($this->config_high_security_enabled);
		$DebugOutput[] = '$this->config_allow_src_above_docroot       = '.$this->phpThumbDebugVarDump($this->config_allow_src_above_docroot);
		$DebugOutput[] = '$this->config_allow_src_above_phpthumb      = '.$this->phpThumbDebugVarDump($this->config_allow_src_above_phpthumb);
		$DebugOutput[] = '$this->config_allow_parameter_file          = '.$this->phpThumbDebugVarDump($this->config_allow_parameter_file);
		$DebugOutput[] = '$this->config_allow_parameter_goto          = '.$this->phpThumbDebugVarDump($this->config_allow_parameter_goto);
		$DebugOutput[] = '';
		$DebugOutput[] = '$this->config_max_source_pixels             = '.$this->phpThumbDebugVarDump($this->config_max_source_pixels);
		$DebugOutput[] = '$this->config_use_exif_thumbnail_for_speed  = '.$this->phpThumbDebugVarDump($this->config_use_exif_thumbnail_for_speed);
		$DebugOutput[] = '$this->config_border_hexcolor               = '.$this->phpThumbDebugVarDump($this->config_border_hexcolor);
		$DebugOutput[] = '$this->config_background_hexcolor           = '.$this->phpThumbDebugVarDump($this->config_background_hexcolor);
		$DebugOutput[] = '$this->config_ttf_directory                 = '.$this->phpThumbDebugVarDump($this->config_ttf_directory);
		$DebugOutput[] = '';

		foreach ($OtherVariableNames as $varname) {
			$value = $this->$varname;
			$DebugOutput[] = '$this->'.str_pad($varname, 27, ' ', STR_PAD_RIGHT).' = '.$this->phpThumbDebugVarDump($value);
		}
		$DebugOutput[] = 'strlen($this->rawImageData)        = '.strlen(@$this->rawImageData);
		$DebugOutput[] = 'strlen($this->exif_thumbnail_data) = '.strlen(@$this->exif_thumbnail_data);
		$DebugOutput[] = '';

		foreach ($ParameterNames as $varname) {
			$value = $this->$varname;
			$DebugOutput[] = '$this->'.str_pad($varname, 4, ' ', STR_PAD_RIGHT).' = '.$this->phpThumbDebugVarDump($value);
		}
		$DebugOutput[] = '';

		foreach ($FunctionsExistance as $functionname) {
			$DebugOutput[] = 'builtin_function_exists('.$functionname.')'.str_repeat(' ', 23 - strlen($functionname)).' = '.$this->phpThumbDebugVarDump(phpthumb_functions::builtin_function_exists($functionname));
		}
		$DebugOutput[] = '';

		$gd_info = phpthumb_functions::gd_info();
		foreach ($gd_info as $key => $value) {
			$DebugOutput[] = 'gd_info.'.str_pad($key, 34, ' ', STR_PAD_RIGHT).' = '.$this->phpThumbDebugVarDump($value);
		}
		$DebugOutput[] = '';

		$exif_info = phpthumb_functions::exif_info();
		foreach ($exif_info as $key => $value) {
			$DebugOutput[] = 'exif_info.'.str_pad($key, 26, ' ', STR_PAD_RIGHT).' = '.$this->phpThumbDebugVarDump($value);
		}
		$DebugOutput[] = '';

		if ($ApacheLookupURIarray = phpthumb_functions::ApacheLookupURIarray(dirname(@$_SERVER['PHP_SELF']))) {
			foreach ($ApacheLookupURIarray as $key => $value) {
				$DebugOutput[] = 'ApacheLookupURIarray.'.str_pad($key, 15, ' ', STR_PAD_RIGHT).' = '.$this->phpThumbDebugVarDump($value);
			}
		} else {
				$DebugOutput[] = 'ApacheLookupURIarray() -- FAILED';
		}
		$DebugOutput[] = '';

		if (isset($_GET) && is_array($_GET)) {
			foreach ($_GET as $key => $value) {
				$DebugOutput[] = '$_GET['.$key.']'.str_repeat(' ', 30 - strlen($key)).'= '.$this->phpThumbDebugVarDump($value);
			}
		}
		if (isset($_POST) && is_array($_POST)) {
			foreach ($_POST as $key => $value) {
				$DebugOutput[] = '$_POST['.$key.']'.str_repeat(' ', 29 - strlen($key)).'= '.$this->phpThumbDebugVarDump($value);
			}
		}
		$DebugOutput[] = '';

		$DebugOutput[] = '$this->debugmessages:';
		foreach ($this->debugmessages as $errorstring) {
			$DebugOutput[] = '  * '.$errorstring;
		}
		$DebugOutput[] = '';

		$DebugOutput[] = '$this->debugtiming:';
		foreach ($this->debugtiming as $timestamp => $timingstring) {
			$DebugOutput[] = '  * '.$timestamp.' '.$timingstring;
		}
		$DebugOutput[] = '  * Total processing time: '.number_format(max(array_keys($this->debugtiming)) - min(array_keys($this->debugtiming)), 6);

		return $this->ErrorImage(implode("\n", $DebugOutput), 700, 500);
	}

	function ErrorImage($text, $width=0, $height=0) {
		$width  = ($width  ? $width  : $this->config_error_image_width);
		$height = ($height ? $height : $this->config_error_image_height);

		$text = 'phpThumb() v'.$this->phpthumb_version."\n\n".$text;
		if ($this->config_disable_debug) {
			$text = 'Error messages disabled';
		}

		$this->DebugMessage($text);
		if (!$this->config_error_die_on_error) {
			$this->fatalerror = $text;
			return false;
		}
		if ($this->config_error_silent_die_on_error) {
			exit;
		}
		if ($this->err || $this->config_error_message_image_default) {
			// Show generic custom error image instead of error message
			// for use on production sites where you don't want debug messages
			if ($this->err == 'showerror') {
				// fall through and actually show error message even if default error image is set
			} else {
				header('Location: '.($this->err ? $this->err : $this->config_error_message_image_default));
				exit;
			}
		}
		if (@$this->f == 'text') {
			// bypass all GD functions and output text error message
			die('<pre>'.$text.'</pre>');
		}

		$FontWidth  = ImageFontWidth($this->config_error_fontsize);
		$FontHeight = ImageFontHeight($this->config_error_fontsize);

		$LinesOfText = explode("\n", @wordwrap($text, floor($width / $FontWidth), "\n", true));
		$height = max($height, count($LinesOfText) * $FontHeight);

		$headers_file = '';
		$headers_line = '';
		if (phpthumb_functions::version_compare_replacement(phpversion(), '4.3.0', '>=') && headers_sent($headers_file, $headers_line)) {

			echo "\n".'**Headers already sent in file "'.$headers_file.'" on line "'.$headers_line.'", dumping error message as text:**<br><pre>'."\n\n".$text."\n".'</pre>';

		} elseif (headers_sent()) {

			echo "\n".'**Headers already sent, dumping error message as text:**<br><pre>'."\n\n".$text."\n".'</pre>';

		} elseif ($gdimg_error = ImageCreate($width, $height)) {

			$background_color = phpthumb_functions::ImageHexColorAllocate($gdimg_error, $this->config_error_bgcolor,   true);
			$text_color       = phpthumb_functions::ImageHexColorAllocate($gdimg_error, $this->config_error_textcolor, true);
			ImageFilledRectangle($gdimg_error, 0, 0, $width, $height, $background_color);
			$lineYoffset = 0;
			foreach ($LinesOfText as $line) {
				ImageString($gdimg_error, $this->config_error_fontsize, 2, $lineYoffset, $line, $text_color);
				$lineYoffset += $FontHeight;
			}
			if (function_exists('ImageTypes')) {
				$imagetypes = ImageTypes();
				if ($imagetypes & IMG_PNG) {
					header('Content-Type: image/png');
					ImagePNG($gdimg_error);
				} elseif ($imagetypes & IMG_GIF) {
					header('Content-Type: image/gif');
					ImageGIF($gdimg_error);
				} elseif ($imagetypes & IMG_JPG) {
					header('Content-Type: image/jpeg');
					ImageJPEG($gdimg_error);
				} elseif ($imagetypes & IMG_WBMP) {
					header('Content-Type: image/wbmp');
					ImageWBMP($gdimg_error);
				}
			}
			ImageDestroy($gdimg_error);

		}
		if (!headers_sent()) {
			echo "\n".'**Failed to send graphical error image, dumping error message as text:**<br>'."\n\n".$text;
		}
		exit;
		return true;
	}

	function ImageCreateFromStringReplacement(&$RawImageData, $DieOnErrors=false) {
		// there are serious bugs in the non-bundled versions of GD which may cause
		// PHP to segfault when calling ImageCreateFromString() - avoid if at all possible
		// when not using a bundled version of GD2
		if (phpthumb_functions::gd_is_bundled()) {
			return @ImageCreateFromString($RawImageData);
		}

		switch (substr($RawImageData, 0, 3)) {
			case 'GIF':
				$ICFSreplacementFunctionName = 'ImageCreateFromGIF';
				break;
			case "\xFF\xD8\xFF":
				$ICFSreplacementFunctionName = 'ImageCreateFromJPEG';
				break;
			case "\x89".'PN':
				$ICFSreplacementFunctionName = 'ImageCreateFromPNG';
				break;
			default:
				return false;
				break;
		}
		if ($tempnam = $this->phpThumb_tempnam()) {
			if ($fp_tempnam = @fopen($tempnam, 'wb')) {
				fwrite($fp_tempnam, $RawImageData);
				fclose($fp_tempnam);
				if (($ICFSreplacementFunctionName == 'ImageCreateFromGIF') && !function_exists($ICFSreplacementFunctionName)) {

					// Need to create from GIF file, but ImageCreateFromGIF does not exist
					ob_start();
					if (!@include_once(dirname(__FILE__).'/phpthumb.gif.php')) {
						$ErrorMessage = 'Failed to include required file "'.dirname(__FILE__).'/phpthumb.gif.php" in '.__FILE__.' on line '.__LINE__;
					}
					ob_end_clean();
					// gif_loadFileToGDimageResource() cannot read from raw data, write to file first
					if ($tempfilename = $this->phpThumb_tempnam()) {
						if ($fp_tempfile = @fopen($tempfilename, 'wb')) {
							fwrite($fp_tempfile, $RawImageData);
							fclose($fp_tempfile);
							$gdimg_source = gif_loadFileToGDimageResource($tempfilename);
							unlink($tempfilename);
							return $gdimg_source;
							break;
						} else {
							$ErrorMessage = 'Failed to open tempfile in '.__FILE__.' on line '.__LINE__;
						}
					} else {
						$ErrorMessage = 'Failed to open generate tempfile name in '.__FILE__.' on line '.__LINE__;
					}

				} elseif (function_exists($ICFSreplacementFunctionName) && ($gdimg_source = @$ICFSreplacementFunctionName($tempnam))) {

					// great
					unlink($tempnam);
					return $gdimg_source;

				} else { // GD functions not available

					// base64-encoded error image in GIF format
					header('Content-Type: image/gif');
					echo base64_decode('R0lGODlhIAAgALMAAAAAABQUFCQkJDY2NkZGRldXV2ZmZnJycoaGhpSUlKWlpbe3t8XFxdXV1eTk5P7+/iwAAAAAIAAgAAAE/vDJSau9WILtTAACUinDNijZtAHfCojS4W5H+qxD8xibIDE9h0OwWaRWDIljJSkUJYsN4bihMB8th3IToAKs1VtYM75cyV8sZ8vygtOE5yMKmGbO4jRdICQCjHdlZzwzNW4qZSQmKDaNjhUMBX4BBAlmMywFSRWEmAI6b5gAlhNxokGhooAIK5o/pi9vEw4Lfj4OLTAUpj6IabMtCwlSFw0DCKBoFqwAB04AjI54PyZ+yY3TD0ss2YcVmN/gvpcu4TOyFivWqYJlbAHPpOntvxNAACcmGHjZzAZqzSzcq5fNjxFmAFw9iFRunD1epU6tsIPmFCAJnWYE0FURk7wJDA0MTKpEzoWAAskiAAA7');
					exit;

				}
			} else {
				$ErrorMessage = 'Failed to fopen('.$tempnam.', "wb") in '.__FILE__.' on line '.__LINE__."\n".'You may need to set $PHPTHUMB_CONFIG[temp_directory] in phpThumb.config.php';
			}
			unlink($tempnam);
		} else {
			$ErrorMessage = 'Failed to generate phpThumb_tempnam() in '.__FILE__.' on line '.__LINE__."\n".'You may need to set $PHPTHUMB_CONFIG[temp_directory] in phpThumb.config.php';
		}
		if ($DieOnErrors && $ErrorMessage) {
			return $this->ErrorImage($ErrorMessage);
		}
		return false;
	}

	function phpThumb_tempnam() {
		return tempnam($this->config_temp_directory, 'pThumb');
	}

	function DebugMessage($message, $file='', $line='') {
		$this->debugmessages[] = $message.($file ? ' in file "'.(basename($file) ? basename($file) : $file).'"' : '').($line ? ' on line '.$line : '');
		return true;
	}

	function DebugTimingMessage($message, $file='', $line='', $timestamp=0) {
		if (!$timestamp) {
			$timestamp = array_sum(explode(' ', microtime()));
		}
		$this->debugtiming[number_format($timestamp, 6, '.', '')] = ': '.$message.($file ? ' in file "'.(basename($file) ? basename($file) : $file).'"' : '').($line ? ' on line '.$line : '');
		return true;
	}

}

?>