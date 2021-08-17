<?php
$cl_builds = new builds();
$cl_builds->set_mainfactor("1.00","0.952381");

$cl_builds->add_build("Headquarters", "main");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("90", "1.26");
$cl_builds->set_stoneprice("80","1.275");
$cl_builds->set_ironprice("70","1.26");
$cl_builds->set_popprice("5","1.17");
$cl_builds->set_time("1080","1.2");
$cl_builds->set_points("10","1.2");
$cl_builds->set_graphicCoords("227,193,227,135,243,127,256,130,268,123,270,112,279,108,290,109,298,119,306,132,325,130,334,138,333,194,290,221,277,226");



$cl_builds->add_build("Barracks", "barracks");
$cl_builds->set_needbuilds(array("main"=>"3"));
$cl_builds->set_maxstage("25");
$cl_builds->set_woodprice("200", "1.26");
$cl_builds->set_stoneprice("170","1.28");
$cl_builds->set_ironprice("90","1.26");
$cl_builds->set_popprice("7","1.17");
$cl_builds->set_time("1800","1.2");
$cl_builds->set_points("16","1.2");
$cl_builds->set_graphicCoords("427,157,431,171,441,181,451,191,461,199,472,204,483,209,499,210,508,203,540,186,541,170,529,153,516,148,497,127,479,116,457,129");

$cl_builds->add_build("Stable", "stable");
$cl_builds->set_needbuilds(array("main"=>"10", "barracks"=>"5", "smith"=>"5"));
$cl_builds->set_maxstage("20");
$cl_builds->set_woodprice("270", "1.26");
$cl_builds->set_stoneprice("240","1.28");
$cl_builds->set_ironprice("260","1.26");
$cl_builds->set_popprice("8","1.17");
$cl_builds->set_time("6000","1.2");
$cl_builds->set_points("20","1.2");
$cl_builds->set_graphicCoords("358,273,306,301,245,291,233,276,262,249,297,221,319,229,353,247");

$cl_builds->add_build("Workshop", "garage");
$cl_builds->set_needbuilds(array("main"=>"10", "smith"=>"10"));
$cl_builds->set_maxstage("15");
$cl_builds->set_woodprice("300", "1.26");
$cl_builds->set_stoneprice("250","1.26");
$cl_builds->set_ironprice("100","1.26");
$cl_builds->set_popprice("8","1.16");
$cl_builds->set_time("6000","1.2");
$cl_builds->set_points("24","1.2");
$cl_builds->set_graphicCoords("55,185,57,202,153,204,165,191,156,172,171,159,167,140,109,104,75,144,74,167");

$cl_builds->add_build("Noble court", "snob");
$cl_builds->set_needbuilds(array("main"=>"20", "smith"=>"20", "market"=>"10"));
$cl_builds->set_maxstage("1");
$cl_builds->set_woodprice("15000", "2");
$cl_builds->set_stoneprice("25000","2");
$cl_builds->set_ironprice("10000","2");
$cl_builds->set_popprice("80","1.17");
$cl_builds->set_time("64800","1.2");
$cl_builds->set_points("512","1.2");
$cl_builds->set_graphicCoords("292,345,323,357,323,367,334,375,344,369,385,332,388,307,373,298,352,302,340,291,314,301,291,317");

$cl_builds->add_build("Smithy", "smith");
$cl_builds->set_needbuilds(array("main"=>"5", "barracks"=>"1"));
$cl_builds->set_maxstage("20");
$cl_builds->set_woodprice("220", "1.26");
$cl_builds->set_stoneprice("180","1.275");
$cl_builds->set_ironprice("240","1.26");
$cl_builds->set_popprice("40","1.17");
$cl_builds->set_time("6000","1.2");
$cl_builds->set_points("19","1.2");
$cl_builds->set_graphicCoords("148,118,187,136,223,128,224,105,219,83,174,65,152,84");

$cl_builds->add_build("Rally place", "place");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("1");
$cl_builds->set_woodprice("10", "1.2");
$cl_builds->set_stoneprice("40","1.2");
$cl_builds->set_ironprice("30","1.2");
$cl_builds->set_popprice("0","1.17");
$cl_builds->set_time("2000","1.2");
$cl_builds->set_points("0","1.2");
$cl_builds->set_graphicCoords("337,215,335,228,341,236,357,243,358,250,373,249,418,220,407,198,389,186");

$cl_builds->add_build("Market", "market");
$cl_builds->set_needbuilds(array("main"=>"3", "storage"=>"2"));
$cl_builds->set_maxstage("25");
$cl_builds->set_woodprice("100", "1.26");
$cl_builds->set_stoneprice("100","1.275");
$cl_builds->set_ironprice("100","1.26");
$cl_builds->set_popprice("20","1.17");
$cl_builds->set_time("2700","1.2");
$cl_builds->set_points("10","1.2");
$cl_builds->set_graphicCoords("413,278,421,288,435,299,451,310,475,304,499,293,515,279,522,269,519,252,507,240,507,225,494,217,467,207,449,202,435,223,418,259");

$cl_builds->add_build("Woodcutter", "wood");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("50", "1.25");
$cl_builds->set_stoneprice("60","1.275");
$cl_builds->set_ironprice("40","1.245");
$cl_builds->set_popprice("5","1.15");
$cl_builds->set_time("900","1.2");
$cl_builds->set_points("6","1.2");
$cl_builds->set_graphicCoords("515,380,515,366,545,332,598,355,597,415,516,414");

$cl_builds->add_build("Stone quarry", "stone");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("65", "1.27");
$cl_builds->set_stoneprice("50","1.265");
$cl_builds->set_ironprice("40","1.24");
$cl_builds->set_popprice("10","1.14");
$cl_builds->set_time("900","1.2");
$cl_builds->set_points("6","1.2");
$cl_builds->set_graphicCoords("1,336,14,338,27,339,37,333,49,343,59,355,78,365,74,377,53,387,54,399,51,409,1,416");

$cl_builds->add_build("Iron mine", "iron");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("75", "1.25");
$cl_builds->set_stoneprice("65","1.275");
$cl_builds->set_ironprice("70","1.24");
$cl_builds->set_popprice("10","1.17");
$cl_builds->set_time("1080","1.2");
$cl_builds->set_points("6","1.2");
$cl_builds->set_graphicCoords("0,73,9,75,21,70,36,69,57,57,97,34,103,25,102,1,1,1");

$cl_builds->add_build("Farm", "farm");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("45", "1.3");
$cl_builds->set_stoneprice("40","1.32");
$cl_builds->set_ironprice("30","1.29");
$cl_builds->set_popprice("0","1");
$cl_builds->set_time("1440","1.2");
$cl_builds->set_points("5","1.2");
$cl_builds->set_graphicCoords("261,77,261,60,277,39,293,43,315,62,327,59,340,46,361,61,380,47,390,56,387,81,398,99,392,119,381,129,357,127,337,105,316,103,294,109,279,101,266,107,244,93");

$cl_builds->add_build("Storage", "storage");
$cl_builds->set_needbuilds(array());
$cl_builds->set_maxstage("30");
$cl_builds->set_woodprice("60", "1.265");
$cl_builds->set_stoneprice("50","1.27");
$cl_builds->set_ironprice("40","1.245");
$cl_builds->set_popprice("0","1");
$cl_builds->set_time("1224","1.2");
$cl_builds->set_points("6","1.2");
$cl_builds->set_graphicCoords("102,277,125,303,163,303,201,283,187,263,156,227,132,219");

$cl_builds->add_build("Wall", "wall");
$cl_builds->set_needbuilds(array("barracks"=>"1"));
$cl_builds->set_maxstage("20");
$cl_builds->set_woodprice("50", "1.26");
$cl_builds->set_stoneprice("100","1.275");
$cl_builds->set_ironprice("20","1.26");
$cl_builds->set_popprice("5","1.18");
$cl_builds->set_time("3600","1.2");
$cl_builds->set_points("8","1.2");
$cl_builds->set_graphicCoords("419,369,417,340,495,312,507,361,432,397");





?>