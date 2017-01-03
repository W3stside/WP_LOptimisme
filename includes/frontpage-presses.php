<?php
//PRESSES SECTION

	add_filter('estore_before_footer_sidebar','david_before_footer_sidebar');
	function david_before_footer_sidebar() {
		if (!is_front_page()) { //checks if front page - else do nothing
			return;
		} else {
		echo '<div class="news_about_us" style="width: 100%; margin: 0 auto;">';
			echo '<div class="news_about_us_wrapper">';
				echo'<h5>Ils parlent de nous!</h5>';
				echo '<div class="container-fluid">';
					echo '<div id="nau_row" class="row">';

			//START CONTENT			

						echo '<div class="col-md-3">';
							echo '<a href="http://www.leparisien.fr/societe/ca-se-travaille-tous-les-jours-18-09-2016-6129265.php"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/leparisien.png" title="le-parisien" alt="le-parisien-presses"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="https://www.francebleu.fr/emissions/ondes-positives/107-1/olivier-toussaint-cofondateur-du-site-loptimisme-com"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/francebleu.png" title="france-bleu" alt="france-bleu-presse"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="https://www.maddyness.com/finance/2016/08/01/maddycrowd-loptimisme-site-dactualites-positives-donne-sourire/"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/maddyness.png" title="maddyness" alt="maddyness-presse"></a>';
						echo '</div>';
						echo '<div class="col-md-3">';
							echo '<a href="http://www.france2.fr/emissions/telematin/videos/replay_-_telematin_20-08-2016_1251773"><img class="nau_image" src="http://localhost/wordpress/wp-content/themes/estore-child/assets/images/presses/digital-business-news.png" title="digital-business-news" alt="digital-business-news-presse"></a>';
						echo '</div>';

			//END CONTENT				

					echo '</div>'; /*row*/
				echo '</div>'; /*container-fluid*/
			echo '</div>'; /*news_about_us_wrapper*/
		echo '</div>'; /*news_about_us*/
		}							
	}