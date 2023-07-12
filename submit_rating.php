<?php
include("inc/db.php");

if(isset($_POST["rating_data"]))
{   $id=$_POST['id_cour'];
	$id_user=$_POST["id_user"];
	$data = array(
		':id_user'		    =>	$_POST["id_user"],
		':user_rating'		=>	$_POST["rating_data"],
		':user_review'		=>	$_POST["user_review"],
		':id_cour'		    =>	$id,
		':datetime'			=>	time()
	);
	$query = "
	INSERT INTO review_table 
	(id_user, user_rating, user_review, datetime ,id_cour) 
	VALUES (:id_user, :user_rating, :user_review, :datetime ,:id_cour)
	";

	$statement = $con->prepare($query);

	$statement->execute($data);

	echo "Your Review & Rating Successfully Submitted";
}


if(isset($_POST["action"]))
{   $id=$_POST['id_cour'];
	

	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
	$review_content = array();


	$query = "select * from review_table where id_cour='$id'";
    $result = $con->query($query, PDO::FETCH_ASSOC);
    

	
	


	foreach($result as $row)
	{   $id_user=$row['id_user'];
        $get_user=$con->prepare("select * from user where id_user='$id_user'");
	    $get_user->setFetchMode(PDO:: FETCH_ASSOC);
	    $get_user->execute();
	    $row_sub=$get_user->fetch();

		$review_content[] = array(
			'user_name'		=>	$row_sub["nome"],
			'user_prenom'	=>	$row_sub["prenom"],
			'user_image'    =>	$row_sub["user_image"],
			'user_review'	=>	$row["user_review"],
			'rating'		=>	$row["user_rating"],
			'datetime'		=>	date('l jS, F Y h:i:s A', $row["datetime"])
		);

		if($row["user_rating"] == '5')
		{
			$five_star_review++;
		}

		if($row["user_rating"] == '4')
		{
			$four_star_review++;
		}

		if($row["user_rating"] == '3')
		{
			$three_star_review++;
		}

		if($row["user_rating"] == '2')
		{
			$two_star_review++;
		}

		if($row["user_rating"] == '1')
		{
			$one_star_review++;
		}

		$total_review++;

		$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	    $average_rating = $total_user_rating / $total_review;
	    $average= $total_user_rating / $total_review;
		
	$output = array(
		'average_rating'	=>	number_format($average_rating, 1),
		'average'	        =>	number_format($average_rating, 1),
		'total'		        =>	$total_review,
		'total_review'		=>	$total_review,
		'five_star_review'	=>	$five_star_review,
		'four_star_review'	=>	$four_star_review,
		'three_star_review'	=>	$three_star_review,
		'two_star_review'	=>	$two_star_review,
		'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);
	echo json_encode($output);
}

?>