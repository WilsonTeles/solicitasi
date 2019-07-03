<?php defined('BASEPATH') or exit('No direct script access allowed');?>

<nav class="navbar navbar-expand-lg navbar-light bg-light" th:fragment="dashboard-navbar(brand, role, activePage)">
		<div class="container">
			<a class="navbar-brand" href="<?php echo base_url() ?>">Where is my classroom</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a href="<?php echo site_url('where_isclass/Admin') ?>" class="nav-link">Turmas</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo site_url('where_isclass/admin/subjects') ?>" class="nav-link">Matérias</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo site_url('where_isclass/admin/teachers') ?>" class="nav-link">Professores</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo site_url('where_isclass/admin/periods') ?>" class="nav-link">Períodos</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo site_url('where_isclass/admin/campus') ?>" class="nav-link">Campus</a>
					</li>
					<li class="nav-item">
						<a href="<?php echo site_url('where_isclass/admin/addresses') ?>" class="nav-link">Endereços</a>
					</li>
				</ul>
			</div>
		</div>
</nav>