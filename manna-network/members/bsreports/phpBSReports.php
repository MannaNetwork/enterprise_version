<?

class phpReport
{
	var $covered;
  var $title;
  var $striped;
  var $bordered;
  var $hover;
	var $header;
	var $footer;
	var $width;
	var $header_color;
	var $header_textcolor;
	var $header_alignment;
	var $body_color;
	var $body_textcolor;
	var $body_alignment;
	var $mysqli_res;
  var $fields = array();
	
	function showReport()
	{
		$this->title=(empty($this->title))?"My Report":$this->title;
    $this->striped=(($this->striped<1))?"":"table-striped";
    $this->bordered=(($this->bordered<1))?"":"table-bordered";
    $this->hover=(($this->hover<1))?"":"table-hover";
		$this->responsive=(($this->responsive<1))?"":"table-responsive";
		$this->inverse=(($this->inverse<1))?"":"table-inverse";
    $this->condensed=(($this->condensed<1))?"":"table-condensed";
    $this->rowformat=$this->rowformat;
		$this->width = (empty($this->width))?"100%":$this->width;
		$this->header_color = (empty($this->header_color))?"#FFFFFF":$this->header_color;
		$this->header_textcolor = (empty($this->header_textcolor))?"#000000":$this->header_textcolor;		
		$this->header_alignment = (empty($this->header_alignment))?"left":$this->header_alignment;
		$this->body_color = (empty($this->body_color))?"#FFFFFF":$this->body_color;
		$this->body_textcolor = (empty($this->body_textcolor))?"#000000":$this->body_textcolor;
		$this->body_alignment = (empty($this->body_alignment))?"left":$this->body_alignment;
		$this->covered = (empty($this->covered))?false:true;
		$this->covered_color = (empty($this->covered_color))?"#000000":$this->covered_color;

	
		$totfields = mysqli_num_fields($this->mysqli_res);
		$i = 0;
		while ($i < $totfields) {
      $field = $this->mysqli_res->fetch_field();  
			$this->fields[$i] = $field->name;      
      if ($field->name==$this->rowformat[1]) { $fldno=$i; $cond="$field->name".$this->rowformat[2]; };
			$i++; }
		echo "<center><b><i>".$this->title."</i></b></center><br>";
		if ($this->covered == true) 
    echo "<div class='container-fluid'><div class='covered' style='display:inline-block; overflow:hidden; width:$this->width' align='center'>";
		echo "<div class='$this->responsive'>";	
		echo "<table class='table $this->striped $this->bordered $this->hover $this->responsive $this->inverse $this->condensed' align='center'>";
    echo "<thead style = 'color:$this->header_textcolor;background-color:$this->header_color'><tr>";
		for ($i = 0; $i< $totfields; $i++)
		{ echo "<th style = 'text-align: $this->header_alignment;'>&nbsp;".$this->fields[$i]."</th>"; }
		echo "</tr></thead><tbody>";
		while ($rows = mysqli_fetch_row($this->mysqli_res)) {
			echo "<tr align = '$this->body_alignment' bgcolor = '$this->body_color'>";
			for ($i = 0; $i < $totfields; $i++)
			{ echo "<td><font color = '$this->body_textcolor'>&nbsp;".$rows[$i]."</font></td>"; }
			echo "</tr>";
		}
    echo "<tr><td align='center' colspan='$totfields'><b>$this->footer</b></td></tr>";
		echo "<tbody></table>";
		echo "</div></div>";
		if ($this->covered == true) { echo "</div>"; }
}
}
?>