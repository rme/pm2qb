<?php
/**
 * class.pm2qb.pmFunctions.php
 *
 * ProcessMaker Open Source Edition
 * Copyright (C) 2004 - 2008 Colosa Inc.
 * *
 */

////////////////////////////////////////////////////
// pm2qb PM Functions
//
// Copyright (C) 2007 COLOSA
//
// License: LGPL, see LICENSE
////////////////////////////////////////////////////

function pm2qb_getMyCurrentDate()
{
	return G::CurDate('Y-m-d');
}

function pm2qb_getMyCurrentTime()
{
	return G::CurDate('H:i:s');
}
