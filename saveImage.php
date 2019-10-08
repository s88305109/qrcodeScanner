<?php
$image = isset($_POST['image']) ? $_POST['image'] : NULL;

if (empty($image)) {
	$result['msg'] = 'error';
	echo json_encode($result);
	exit;
}

$head = substr($image, 0, 22);

if ($head != 'data:image/png;base64,') {
	$result['msg'] = 'error';
	echo json_encode($result);
	exit;
}

$cut = explode(',', $image);

if (! isset($cut[1])) {
	$result['msg'] = 'error';
	echo json_encode($result);
	exit;
}

$bin = base64_decode($cut[1]);
$filename = date('YmdHis_').rand(1000, 9999).'.png';
file_put_contents('./images/'.$filename, $bin);

$result['msg'] = 'success';
$result['filename'] = $filename;

echo json_encode($result);
