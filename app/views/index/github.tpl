<section class="row">
	<section class="column c50">
		<h1>GitHub</h1>
		<p>
			Visit me on <a href="https://github.com/staubrein">GitHub</a>.
		</p>
	</section>
	<section class="column c50 github_list">
		<ul>
			<?php if($repositories) {
				
				// iterate through all repositories 
				foreach ($repositories as $repos => $repo) {
					echo '<li><a href="' . $repo['html_url'] . '">' . $repo['name'] . '</a></li>';
				}
			} ?>
		</ul>
	</section>
</section>