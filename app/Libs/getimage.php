<?php

namespace app\Libs;

class getimage {
	public function links($id) {
		error_log ( '????????????????' . $id );
		$logimages = Logimage::select ( 'image' )->where ( 'no', $id )->first ();

		header ( 'Content-type: image/jpeg' );
		header ( "Content-Disposition: inline; filename=image.jpg" );
		$img_data = pg_unescape_bytea ( $logimages->image );
		echo $img_data;
	}
}

?>