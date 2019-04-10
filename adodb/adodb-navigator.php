<?php

class CData_PagerNav
{
	var	$connect;
	var	$sql;
	
	var	$form_name;
	var	$address;
	var	$parameters;
	var	$id = "curr_page";
	
	var	$count_rows;
	var	$count_rows_page;
	var	$count_page;
	var	$curr_page;
	
	var	$curr_rs;
	var	$index_rs;
	
	var	$style = "nav";
	//$c=$_SERVER['SERVER_NAME'];title='http://localhost/IPCuba/imagenes/fist.JPG'
	var	$first = "";
	var	$prev = "";

	var	$next = "";
	var	$last = "";
	var	$separator = "&nbsp;&nbsp;";
		
	function CData_PagerNav($connect, $sql, $count_rows_page, $form_name = "", $order,$ordtype)
	{
		GLOBAL $_SERVER, $_GET;
		
		$this->order = $order;
		
		$this->ordtype = $ordtype;

		$this->form_name = $form_name;

		$this->address = $_SERVER['PHP_SELF'];

		$this->connect = $connect;

		$this->sql = $sql;
		
	$this->first ="<img width='16' height='20' src='http://".$_SERVER['HTTP_HOST']."/IPCuba/imagenes/extrasmall/tab_first.gif'  border='0' title='Primera'>";
	
	
	$this->prev = "<img width='16' height='20' src='http://".$_SERVER['HTTP_HOST']."/IPCuba/imagenes/extrasmall/tab_left.gif' border='0'title='Anterior'>";

	$this->next = "<img width='16' height='20' src='http://".$_SERVER['HTTP_HOST']."/IPCuba/imagenes/extrasmall/tab_right.gif' border='0'title='Siguiente'>";
	$this->last = "<img width='16' height='20' src='http://".$_SERVER['HTTP_HOST']."/IPCuba/imagenes/extrasmall/tab_last.gif' border='0' title='Ultima'>";
		
		

		$this->count_rows_page = $count_rows_page;

		$this->count_page = $this->CountPage();

		if (isset($_GET[$this->id]))
		{
			if ($_GET[$this->id] < 1)
			{
				$this->curr_page = 1;
			}
			elseif ($_GET[$this->id] > $this->count_page)
			{
				$this->curr_page = $this->count_page;
			}
			else
			{
				$this->curr_page = $_GET[$this->id];
			}
		}
		else
		{
			$this->curr_page = 1;
		}

		$this->curr_rs = $this->connect->PageExecute($this->sql, $this->count_rows_page, $this->curr_page);

		$this->index_rs = ((($this->curr_page)-1)*$this->count_rows_page)+1;
	}

	function CountPage()
	{
		$rs = $this->connect->Execute($this->sql);
		
		if($rs->fields[0]!='')// realizado por Raydel Ojeda---if para cuando no hay recordsets
		{

		$this->count_rows = $rs->RecordCount();

		$div = $this->count_rows/$this->count_rows_page;

		$count_page = ($this->count_rows%$this->count_rows_page)? ceil($div) : $div;
		}

		return $count_page;
	}

	function Convert_Arr()
	{
		$get_par = "";

		foreach ($this->parameters as $key => $value)
		{
			$get_par.=($key != $this->id)? "&".$key."=".$value : '';
		}
		return $get_par;
	}

	function Address($num_page)
	{
		return $this->address."?".$this->id."=".$num_page.$this->Convert_Arr();
	}

	function Create_Cod($address)
	{
		$cod="document.".$this->form_name.".action='".$address."';" ;

		$cod.="document.".$this->form_name.".submit();";

		return $cod;
	}

	function Render_First()
	{
		if ($this->curr_page > 1)
		{
			$num_page = "1";

			$address = $this->Address($num_page)."&order=".$this->order."&type=".$this->ordtype;

			if ($this->form_name)
			{
				$option = '<span class="'.$this->style.'" onClick="'.$this->Create_Cod($address).'">'.$this->first.'</span>';
			}
			else
			{
				$option = '<a href="'.$address.'">'.$this->first.'</a>';
			}
		}
		else
		{
			$option = $this->first;
		}
		echo $option.$this->separator;
	}

	function Render_Prev()
	{
		if ($this->curr_page > 1)
		{
			$num_page = $this->curr_page - 1;

			$address = $this->Address($num_page)."&order=".$this->order."&type=".$this->ordtype;

			if ($this->form_name)
			{
				$option = '<span class="'.$this->style.'" onClick="'.$this->Create_Cod($address).'">'.$this->prev.'</span>';
			}
			else
			{
				$option = '<a href="'.$address.'">'.$this->prev.'</a>';
			}
		}
		else
		{
			$option = $this->prev;
		}
		echo $option.$this->separator;
	}

	function Render_Next()
	{
		if ($this->curr_page < $this->count_page)
		{
			$num_page = $this->curr_page + 1;

			$address = $this->Address($num_page)."&order=".$this->order."&type=".$this->ordtype;

			if ($this->form_name)
			{
				$option = '<span class="'.$this->style.'" onClick="'.$this->Create_Cod($address).'">'.$this->next.'</span>';
			}
			else
			{
				$option = '<a href="'.$address.'">'.$this->next.'</a>';
			}
		}
		else
		{
			$option = $this->next;
		}
		echo $option.$this->separator;
	}

	function Render_Last()
	{
		if ($this->curr_page < $this->count_page)
		{
			$num_page = $this->count_page;

			$address = $this->Address($num_page)."&order=".$this->order."&type=".$this->ordtype;

			if ($this->form_name)
			{

				$option = '<span class="'.$this->style.'" onClick="'.$this->Create_Cod($address).'">'.$this->last.'</span>';
				
			}
			else
			{
				$option = '<a href="'.$address.'">'.$this->last.'</a>';
			}
		}
		else
		{
			$option = $this->last;
		}
		echo $option;
	}

	function Render_Navegator($parameters = array())
	{
		if ($this->count_page > 1)
		{
			$this->parameters = $parameters;
			$this->Render_First();
			$this->Render_Prev();
			$this->Render_Next();
			$this->Render_Last();
		}
		else
		{
			echo "&nbsp;";
		}
	}
}

?>