<?php

class OMDocxConversion{
    private $filename;

    public function __construct($filePath) {
        $this->filename = $filePath;
    }

    /************************word doc************************************/

    private function read_doc() {
        $fileHandle = fopen($this->filename, "r");
        $line = @fread($fileHandle, filesize($this->filename));
        $lines = explode(chr(0x0D),$line);
        $outtext = "";
        foreach($lines as $thisline)
          {

            $pos = strpos($thisline, chr(0x00));
            if (($pos !== FALSE)||(strlen($thisline)==0))
              {
              } else {
                $outtext .= $thisline." ";

              }
          }
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext);

        return $outtext;
    }

    /************************word docx************************************/

    private function read_docx(){

        $striped_content = '';
        $content = '';

        $zip = zip_open($this->filename);

        if (!$zip || is_numeric($zip)) return false;

        while ($zip_entry = zip_read($zip)) {

            if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

            if (zip_entry_name($zip_entry) != "word/document.xml") continue;

            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

            zip_entry_close($zip_entry);
        }// end while

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }

 	/************************excel sheet xlsx************************************/

	function xlsx_to_text(){
	    $xml_filename = "xl/sharedStrings.xml"; //content file name
	    $zip_handle = new ZipArchive;
	    $output_text = "";
	    if(true === $zip_handle->open($this->filename)){
	        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
	            $xml_datas = $zip_handle->getFromIndex($xml_index);
	            $xml_handle = @DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
	            $output_text = strip_tags($xml_handle->saveXML());
	        }else{
	            $output_text .="";
	        }
	        $zip_handle->close();
	    }else{
	    $output_text .="";
	    }
	    return $output_text;
	}

	/*************************excel files xls*****************************/

	function xls_to_text(){
		require_once('../../system/library/PHPExcel/IOFactory.php');

		$objPHPExcel = PHPExcel_IOFactory::load($this->filename);

		$count =  $objPHPExcel->getSheetCount();
		$text = "";

		if($count > 0){
			for ($i=0; $i < $count; $i++) {

				$sheetData = $objPHPExcel->getSheet($i)->toArray(null,false,false,true);

				$text .= $this->arrayToPlainText($sheetData);
			}
		}


		return $text;

	}

	/*************************power point files*****************************/
	function pptx_to_text(){

	    $zip_handle = new ZipArchive;
	    $output_text = "";
	    if(true === $zip_handle->open($this->filename)){
	        $slide_number = 1; //loop through slide files
	        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
	            $xml_datas = $zip_handle->getFromIndex($xml_index);
	            $xml_handle = @DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
	            $output_text .= strip_tags($xml_handle->saveXML());
	            $slide_number++;
	        }
	        if($slide_number == 1){
	            $output_text .="";
	        }
	        $zip_handle->close();
	    }else{
	    $output_text .="";
	    }
	    return $output_text;
	}

	function pdf_to_text(){
		$pdf_txt = shell_exec('pdftotext '.$this->filename.' -');

		$str_replace_a = array("","","","","","","","","","","","","","","","","","","","","","","","","�","�","\n");
		$str_replace_b = array('่','้','๊','๋','์','ิ','ี','ึ','ื','่','้','๊','๋','์','ั','ํ','็','่','้','๊','๋','์','ญ','ฐ','่','่',"");

		$pdf_txt = str_replace($str_replace_a, $str_replace_b, $pdf_txt);

		return $pdf_txt;
	}

    public function convertToText() {

        if(isset($this->filename) && !file_exists($this->filename)) {
            return "";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "xls" || $file_ext == "pptx" || $file_ext == "pdf")
        {
            if($file_ext == "doc") {
                return $this->read_doc();
            } elseif($file_ext == "docx") {
                return $this->read_docx();
            } elseif($file_ext == "xlsx") {
                return $this->xlsx_to_text();
            }elseif($file_ext == "xls") {
                return $this->xls_to_text();
            }elseif($file_ext == "pptx") {
                return $this->pptx_to_text();
            }elseif($file_ext == "pdf") {
                return $this->pdf_to_text();
            }
        } else {
            return "";
        }
    }

    public function arrayToPlainText( array $array ) {

	    $text = "";
	    foreach( $array as $key => $val ) {
	        if( is_array( $val ) ) {
	            $text .= $this->arrayToPlainText($val);
	        } elseif ( is_object( $val ) ) {
	            $text .= clone $val;
	        } else {
	            $text .= $val;
	        }
	        $text .= " ";
	    }
	    return $text;
	}
}

?>