		
		<?php if($repositories) {
			
			// iterate through all repositories 
			foreach ($repositories as $repos => $repo) {
				echo '<p><a href="' . $repo['html_url'] . '">' . $repo['name'] . '</a><p>';
			}
		} ?>