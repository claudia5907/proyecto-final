<?php 
require_once('fpdf.php');
class VariableStream
{
	var $varname;
	var $position;

	function stream_open($path, $mode, $options, &$opened_path)
	{
		$url = parse_url($path);
		$this->varname = $url['host'];
		if(!isset($GLOBALS[$this->varname]))
		{
			trigger_error('Global variable '.$this->varname.' does not exist', E_USER_WARNING);
			return false;
		}
		$this->position = 0;
		return true;
	}

	function stream_read($count)
	{
		$ret = substr($GLOBALS[$this->varname], $this->position, $count);
		$this->position += strlen($ret);
		return $ret;
	}

	function stream_eof()
	{
		return $this->position >= strlen($GLOBALS[$this->varname]);
	}

	function stream_tell()
	{
		return $this->position;
	}

	function stream_seek($offset, $whence)
	{
		if($whence==SEEK_SET)
		{
			$this->position = $offset;
			return true;
		}
		return false;
	}
	
	function stream_stat()
	{
		return array();
	}
}
/************************* CLASE MODIFICADO CON GRAFICOS y BOOKMARK *****************************/
class PDF_Bookmark extends FPDF
{
    var $outlines=array();
    var $OutlineRoot;
    function PDF_Bookmark($orientation='P', $unit='mm', $format='A4')// contructor para grafico mas
    {
        $this->FPDF($orientation, $unit, $format);
        stream_wrapper_register('var', 'VariableStream');
            
    }    
    function Bookmark($txt, $level=0, $y=0)
    {
    	if($y==-1)
    		$y=$this->GetY();
    	$this->outlines[]=array('t'=>$txt, 'l'=>$level, 'y'=>($this->h-$y)*$this->k, 'p'=>$this->PageNo());
    }
    
    function BookmarkUTF8($txt, $level=0, $y=0)
    {
    	$this->Bookmark($this->_UTF8toUTF16($txt),$level,$y);
    }
    
    function _putbookmarks()
    {
    	$nb=count($this->outlines);
    	if($nb==0)
    		return;
    	$lru=array();
    	$level=0;
    	foreach($this->outlines as $i=>$o)
    	{
    		if($o['l']>0)
    		{
    			$parent=$lru[$o['l']-1];
    			//Set parent and last pointers
    			$this->outlines[$i]['parent']=$parent;
    			$this->outlines[$parent]['last']=$i;
    			if($o['l']>$level)
    			{
    				//Level increasing: set first pointer
    				$this->outlines[$parent]['first']=$i;
    			}
    		}
    		else
    			$this->outlines[$i]['parent']=$nb;
    		if($o['l']<=$level and $i>0)
    		{
    			//Set prev and next pointers
    			$prev=$lru[$o['l']];
    			$this->outlines[$prev]['next']=$i;
    			$this->outlines[$i]['prev']=$prev;
    		}
    		$lru[$o['l']]=$i;
    		$level=$o['l'];
    	}
    	//Outline items
    	$n=$this->n+1;
    	foreach($this->outlines as $i=>$o)
    	{
    		$this->_newobj();
    		$this->_out('<</Title '.$this->_textstring($o['t']));
    		$this->_out('/Parent '.($n+$o['parent']).' 0 R');
    		if(isset($o['prev']))
    			$this->_out('/Prev '.($n+$o['prev']).' 0 R');
    		if(isset($o['next']))
    			$this->_out('/Next '.($n+$o['next']).' 0 R');
    		if(isset($o['first']))
    			$this->_out('/First '.($n+$o['first']).' 0 R');
    		if(isset($o['last']))
    			$this->_out('/Last '.($n+$o['last']).' 0 R');
    		$this->_out(sprintf('/Dest [%d 0 R /XYZ 0 %.2F null]',1+2*$o['p'],$o['y']));
    		$this->_out('/Count 0>>');
    		$this->_out('endobj');
    	}
    	//Outline root
    	$this->_newobj();
    	$this->OutlineRoot=$this->n;
    	$this->_out('<</Type /Outlines /First '.$n.' 0 R');
    	$this->_out('/Last '.($n+$lru[0]).' 0 R>>');
    	$this->_out('endobj');
    }
    
    function _putresources()
    {
        parent::_putresources();
        $this->_putbookmarks();
    }
    
    function _putcatalog()
    {
    	parent::_putcatalog();
    	if(count($this->outlines)>0)
    	{
    		$this->_out('/Outlines '.$this->OutlineRoot.' 0 R');
    		$this->_out('/PageMode /UseOutlines');
    	}
    }
    
    /****************** GRAFICO*********************************/
    
    function MemImage($data, $x=null, $y=null, $w=0, $h=0, $link='')
	{
		//Display the image contained in $data
		$v = 'img'.md5($data);
		$GLOBALS[$v] = $data;
		$a = getimagesize('var://'.$v);
		if(!$a)
			$this->Error('Invalid image data');
		$type = substr(strstr($a['mime'],'/'),1);
		$this->Image('var://'.$v, $x, $y, $w, $h, $type, $link);
		unset($GLOBALS[$v]);
	}

	function GDImage($im, $x=null, $y=null, $w=0, $h=0, $link='')
	{
		//Display the GD image associated to $im
		ob_start();
		imagepng($im);
		$data = ob_get_clean();
		$this->MemImage($data, $x, $y, $w, $h, $link);
	}  
    
    /******************* AGREGANDO UN INDEX PAGINADOR********/
    function CreateIndex()
    {
	    //Index title
    	$this->SetFontSize(11);
    	$this->Cell(0,15,'INDICE',0,1,'C');
    	$this->SetFontSize(15);
    	$this->Ln(10);
    
    	$size=sizeof($this->outlines);
    	$PageCellSize=$this->GetStringWidth('p. '.$this->outlines[$size-1]['p'])+2;
        	for ($i=0;$i<$size;$i++)
            {
        		//Offset
        		$level=$this->outlines[$i]['l'];
        		if($level>0)
        			$this->Cell($level*8);
        
        		//Caption
        		$str=$this->outlines[$i]['t'];
        		$strsize=$this->GetStringWidth($str);
        		$avail_size=$this->w-$this->lMargin-$this->rMargin-$PageCellSize-($level*8)-4;
        		while ($strsize>=$avail_size){
        			$str=substr($str,0,-1);
        			$strsize=$this->GetStringWidth($str);
        		}
        		$this->Cell($strsize+2,$this->FontSize+2,$str);
        
        		//Filling dots
        		$w=$this->w-$this->lMargin-$this->rMargin-$PageCellSize-($level*8)-($strsize+2);
        		$nb=$w/$this->GetStringWidth('.');
        		$dots=str_repeat('.',$nb);
        		$this->Cell($w,$this->FontSize+2,$dots,0,0,'R');
        
        		//Page number
        		$this->Cell($PageCellSize,$this->FontSize+1,'p. '.$this->outlines[$i]['p'],0,1,'R');
        	}
     }              

}
?>