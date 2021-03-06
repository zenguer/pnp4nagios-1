<?php

  $ds_name[1] = "TCP traffic";
  $opt[1] = "--vertical-label \"bits/s\" -l0 --title \"Traffic for $hostname / $servicedesc\" ";

  # In & Out
  $def[1] = rrd::def("in_bytes", $RRDFILE[1], $DS[2], "AVERAGE");
  $def[1] .= rrd::def("out_bytes", $RRDFILE[1], $DS[3], "AVERAGE");
  $def[1] .= rrd::cdef("in_bits", "in_bytes,8,*");
  $def[1] .= rrd::cdef("in_mbits", "in_bits,1048576,/");
  $def[1] .= rrd::cdef("out_bits", "out_bytes,8,*");
  $def[1] .= rrd::cdef("out_mbits", "out_bits,1048576,/");

  # Thresholds
  $def[1] .= "HRULE:$WARN[1]#FFFF00 ";
  $def[1] .= "HRULE:$CRIT[1]#FF0000 ";

  # In
  $def[1] .= rrd::area("in_bits", "#00FF00", "In");
  $def[1] .= "GPRINT:in_mbits:LAST:\"%6.2lf Mbits/s last\" " ;
  $def[1] .= "GPRINT:in_mbits:AVERAGE:\"%6.2lf Mbits/s avg\" " ;
  $def[1] .= "GPRINT:in_mbits:MAX:\"%6.2lf Mbits/s max\\n\" ";

  # Out
  $def[1] .= rrd::line1("out_bits", "#0000FF", "Out");
  $def[1] .= "GPRINT:out_mbits:LAST:\"%6.2lf Mbits/s last\" " ;
  $def[1] .= "GPRINT:out_mbits:AVERAGE:\"%6.2lf Mbits/s avg\" " ;
  $def[1] .= "GPRINT:out_mbits:MAX:\"%6.2lf Mbits/s max\\n\" ";
?>
