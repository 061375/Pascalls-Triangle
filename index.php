<?php
/** 
 * Pascal's Triangle
 * @author Jeremy Heminger <j.heminger13@gmail.com>
 * 2017
 * Just for the fun of it...I got on a triangle math's kick
 * 
 * */



/** 
 * @param int an uneven integer
 * @return array
 * */
function pt($w) {
    if(gettype($w / 2) == 'integer') {
        die("\nthe number must be odd\n");
    }
    // x , y variables for drawing the triangle
    $px = 1;
    $py = 1;

    // (n choose k)
    $n = 0;
    $k = 0;

    //  n
    // ---
    //  d
    $numerator = 0;
    $denominator = 0;
    
    $out = array();
    
    while($py <= $w) {
        for($px=1;$px<=$w;$px++) {
            if($px <= (($w - $py) / 2)) {
                $out[$px][$py] = null;
                $n = 0;
            }elseif($px > ((($w - $py) / 2)+$py)){
                $out[$px][$py] = null;
                $n = 0;
            }else{
                // n = k!
                $numerator = factoral($k);
                // d = n!(k - n)!
                $denominator = factoral($n) * factoral($k - $n);
                // r = n
                //     -
                //     d
                $result = $numerator / $denominator;
                // add result to the array
                $out[$px][$py] = $result;
                // increment n
                $n++;
            }
        }
        $k++;
        $py++;
    }
    return $out;
}
/** 
 * returns the factoral of an integer 
 * example: 4 = 4 * 3 * 2 * 1;
 * @param int 
 * @return int
 * */
function factoral($n) {
    // init the return
    $r = 1;
    for($f = 1; $f <= $n; $f++) {
        $r = $r * $f;
    }
    return $r;
}
?>
<!DOCTYPE html>

<html>
<head>
    <title>Pascall's Triangle Art</title>
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous"></script>
    <script type="text/javascript">
        /** 
         * Some Javascript to format the triangle in HTML
         * @binding jQuery
         */
        $(document).ready(function(){
            var td = 0;
            // loop evey row
            $('tr').each(function(){
                td = 0;
                // set a base width for the row
                var mxw = 0;
                // loop each cell on this row
                $(this).find('td').each(function(){
                    td++;
                    // if this cell is the widest, then set it as the max
                    if($(this).width() > mxw) {
                        mxw = $(this).width();
                    }
                });
                // set all the cells as the same width (max)
                $(this).find('td').css('width',mxw);
            });
        });
      </script>
    <style>
        body {
            color: #94d3ff;
            text-shadow: 1px 1px 16px rgba(0, 0, 0, 0.41);
            font-family: Arial;
            font-size: 10px;
            background: rgb(37,141,200);
            background: -moz-linear-gradient(top, rgba(37,141,200,1) 0%, rgba(37,141,200,1) 38%, rgba(27,102,142,1) 100%);
            background: -webkit-linear-gradient(top, rgba(37,141,200,1) 0%,rgba(37,141,200,1) 38%,rgba(27,102,142,1) 100%);
            background: linear-gradient(to bottom, rgba(37,141,200,1) 0%,rgba(37,141,200,1) 38%,rgba(27,102,142,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#258dc8', endColorstr='#1b668e',GradientType=0 );
        }
        body > img {
            position: fixed;
            z-index: 9999;
            margin: 10px;
            right: 0;
            top: 0;
        }
        table {
            position: relative;
            left: -290vw;
        }
        td {
            text-align: center;
        }
        tr:nth-child(even) td {
            position: relative;
            left: -1%;
        }
        @media screen and (max-width: 1440px) {
            table {
                left: -386vw;
            }
        }
        @media screen and (max-width: 1280px) {
            table {
                left: -440vw;
            }
        }
        </style>
</head>

<body>
<img src="p-tri-title.png" />
<table>
    <?php
    $fs = 40;
    $sw = false;
    // build the table
    $r = pt(65);
    // loop the x part of the array
    for($x = 0; $x < count($r); $x++) {
        // open a row
        echo '<tr style="font-size:'.$fs.'px">';
        
        if($fs < 2)$sw = true;
        
        if($sw === false) {
            $fs--;
        }else{
            $fs++;
        }
        // loop the y part of the array
        for($y = 0; $y < count($r[$x]); $y++) {
            // reverse the coords ( or the trinagle will appear sideways)
            // also check if null ( if NOT then render number )
            echo '<td>'.((null !== $r[$y][$x]) ? number_format($r[$y][$x],0,'','') : '').'</td>';
        }
        // close the row
        echo '</tr>';
    }
    ?>
</table>


</body>
</html>
