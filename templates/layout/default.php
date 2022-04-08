<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<base href="<?php echo $this->Url->build('/', ['fullBase' => true]); ?>">

		<?php echo $this->Html->meta('viewport', 'width=device-width, initial-scale=1, user-scalable=0, shrink-to-fit=no') ?>
		<?php echo $this->Html->charset() ?>

		<?php echo $this->Html->meta('favicon.ico', '/favicon.ico', ['type' => 'icon']); ?>
				
		<title><?php echo $pagina->titulo; ?></title>

		<?php echo $this->Html->meta('description', $pagina->descricao); ?>


		<?php echo $this->Html->meta('twitter:card', 'summary'); ?>
		
		<?php echo $this->Html->meta(['property' => 'og:url', 'content' => $this->Url->build($this->request->getRequestTarget(), ['fullBase' => true])]); ?>
		<?php echo $this->Html->meta(['property' => 'og:type', 'content' => 'website']); ?>
		<?php echo $this->Html->meta(['property' => 'og:title', 'content' => $pagina->titulo_compartilhamento]); ?>
		<?php echo $this->Html->meta(['property' => 'og:description', 'content' => $pagina->descricao_compartilhamento]); ?>
		<?php echo $this->Html->meta(['property' => 'og:image', 'content' => $this->Url->assetUrl($pagina->imagem['endereco'], ['fullBase' => true])]); ?>
		<?php echo $this->Html->meta(['property' => 'og:image:type', 'content' => $pagina->imagem['tipo']]); ?>
		<?php echo $this->Html->meta(['property' => 'og:image:width', 'content' => $pagina->imagem['largura']]); ?>
		<?php echo $this->Html->meta(['property' => 'og:image:height', 'content' => $pagina->imagem['altura']]); ?>

		<?php echo $this->Html->meta('robots', 'index, follow'); ?>

		<?php echo $this->Html->css([
			'https://fonts.googleapis.com',
		], ['rel' => 'preconnect']); ?>

		<?php /* echo $this->Html->css([
			'https://fonts.gstatic.com',
		], ['rel' => 'preconnect', 'crossorigin' => 'crossorigin']); */ ?>

		<?php /* echo $this->Html->css([
			'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;900&display=swap',
			'https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap',
		], ['rel' => 'preload', 'as' => 'font', 'crossorigin' => 'crossorigin']); */ ?>

		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>

		<link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;900&display=swap" as="font" crossorigin/>
		<link rel="preload" href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap" as="font" crossorigin/>

		<?php echo $this->Html->css([
			'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;900&display=swap',
			'https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap',
		], ['once' => false]); ?>

		<?php echo $this->Html->css([
			'/site/css/normalize.css',
			'/site/css/style.css',	
			'/site/css/select2.css',
			'/site/css/sweetalert2.css',
		], ['rel' => 'preload', 'as' => 'style']); ?>

		<?php echo $this->Html->css([
			'/site/css/normalize.css',
			'/site/css/style.css',
			'/site/css/select2.css',
			'/site/css/sweetalert2.css',
		], ['once' => false]); ?>

		<!-- PAGE STYLES -->
		<?php echo $this->fetch('css'); ?>

		<!-- PRELOAD SCRIPTS -->
		<?php echo $this->Html->meta([
			'rel' => 'preload',
			'link' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js',
			'as' => 'script'
		]); ?>

		<?php echo $this->Html->meta([
			'rel' => 'preload',
			'link' => '/site/js/functions.js',
			'as' => 'script'
		]); ?>

		<meta name="facebook-domain-verification" content="d5uzppfozm4eujrlltl5d0yihf95p2" />

		<!-- Google Tag Manager -->
		<script>
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-MJZSWHT');</script>
		<!-- End Google Tag Manager -->

	</head>
	<body>
		<header class="header">
			<div class="content">
				<div class="menu">
					<h1 class="menu__title">
						<?php echo $this->Html->link(
							$this->Html->image('/site/img/logo.png', ['class' => 'menu__logo img-fluid', 'alt' => 'Favorita']),
							['controller' => 'home', 'action' => 'index'],
							['escape' => false, 'class' => 'menu__home']
						) ?>
					</h1>

					<div class="menu__navigation-container">
						<nav class="menu__navigation">
							<ul class="menu__list list-style-none">
								<li class="menu__item"><?php echo $this->Html->link('Home', ['controller' => 'home', 'action' => 'index'], ['class' => 'menu__btn' . ($this->name == 'Home' ? ' menu__btn--active' : null)]); ?></li>
								<li class="menu__item"><?php echo $this->Html->link('Sobre', ['controller' => 'sobre', 'action' => 'index'], ['class' => 'menu__btn' . ($this->name == 'Sobre' ? ' menu__btn--active' : null)]); ?></li>
								<li class="menu__item">
									<?php echo $this->Html->link('Ambientes', ['controller' => 'ambientes', 'action' => 'index'], ['class' => 'menu__btn' . (in_array($this->name, ['Ambientes', 'Acabamentos']) ? ' menu__btn--active' : null)]); ?>

									<!-- <?php echo $this->Html->link('mais', 'javascript:void(0);', ['class' => 'menu__btn-expand-submenu', 'data-alternate' => 'menos']); ?>

									<div class="submenu">
										<ul class="submenu__list list-style-none">
											<li class="submenu__item"><?php echo $this->Html->link('Acabamentos', ['controller' => 'acabamentos', 'action' => 'index'], ['class' => 'submenu__btn']); ?></li>
										</ul>
									</div> -->
								</li>
								<li class="menu__item"><?php echo $this->Html->link('Onde encontrar', ['controller' => 'lojas', 'action' => 'index'], ['class' => 'menu__btn' . ($this->name == 'Lojas' ? ' menu__btn--active' : null)]); ?></li>
								<li class="menu__item"><?php echo $this->Html->link('Blog', ['controller' => 'blog', 'action' => 'index'], ['class' => 'menu__btn' . ($this->name == 'Blog' ? ' menu__btn--active' : null)]); ?></li>
								<li class="menu__item"><?php echo $this->Html->link('Solicite seu projeto', ['controller' => 'projetos', 'action' => 'index'], ['class' => 'menu__btn menu__btn--highlight btn']); ?></li>
							</ul>

							<?php if (!in_array($this->name, ['Projetos', 'Atendimento', 'TourVirtual', 'Politica'])) { ?>
							<i class="menu__indicator"></i>
							<?php } ?>
						</nav>

						<div class="social social--header">
							<ul class="social__list list-style-none">
								<li class="social__item">
									<?php echo $this->Html->link(
										$this->Html->image('/site/img/facebook-2.svg', ['class' => 'social__icon']),
										'https://www.facebook.com/casabrasileiraoficial',
										['escape' => false, 'class' => 'social__btn', 'target' => '_blank']
									); ?>
								</li>
								<li class="social__item">
									<?php echo $this->Html->link(
										$this->Html->image('/site/img/instagram-2.svg', ['class' => 'social__icon']),
										'https://www.instagram.com/casabrasileiraoficial',
										['escape' => false, 'class' => 'social__btn', 'target' => '_blank']
									); ?>
								</li>
							</ul>
						</div>
					</div>

					<?php echo $this->Html->link('<div class="burguer-menu__containment"> <div> <span>Menu</span> </div> </div>', 'javascript:void(0);', ['escape' => false, 'class' => 'burguer-menu']); ?>
				</div>
			</div>
		</header>

		<?php echo $this->fetch('content'); ?>

		<footer>
			<?php if ($this->name != 'Projetos') { ?>
			<div class="float-container">
				<div class="modal" style="display: none;">
					<h2>Solicite um projeto</h2>
				   <span class="close-modal">&times;</span>
					<?php echo $this->Form->create(null, array('url' => array('controller' => 'projetos', 'action' => 'index'), 'type' => 'file', 'class' => 'form form--async form--column',  'id' => 'Solicite' . $this->name, 'templates' => ['inputContainer' => '{{content}}'])) ?>
						<fieldset class="form__fieldset">
							<div class="form__row">
								<div class="form__group">
									<?php echo $this->Form->control('nome', ['type' => 'text', 'label' => ['text' => 'Nome*', 'class' => 'form__label'], 'class' => 'form__control', 'placeholder' => 'Nome']) ?>
								</div>
							</div>

							<div class="form__row">
								<div class="form__group">
									<?php echo $this->Form->control('telefone', ['type' => 'text', 'label' => ['text' => 'Telefone*', 'class' => 'form__label'], 'class' => 'form__control form_control--mask-phone', 'placeholder' => 'Telefone']) ?>
								</div>
							</div>

							<div class="form__row">
								<div class="form__group">
									<?php echo $this->Form->control('email', ['type' => 'text', 'label' => ['text' => 'E-mail*', 'class' => 'form__label'], 'class' => 'form__control', 'placeholder' => 'E-mail']) ?>
								</div>
							</div>

							<div class="form__row">
								<div class="form__group">
									<?php echo $this->Form->control('cep', ['type' => 'text', 'label' => ['text' => 'CEP*', 'class' => 'form__label'], 'class' => 'form__control form_control--mask-zip-code', 'placeholder' => 'CEP']) ?>
								</div>
							</div>

							

							<div class="form__row">
								<div class="form__group">
									<?php $this->Form->unlockField('investimento'); ?>
									<?php echo $this->Form->control('investimento', [
										'type' => 'select',
										'options'=> array(
											'-1' => 'Selecione a expectativa',
											// '5_10' => 'Entre R$5.000 a R$10.000',
											'10_20' => 'Entre R$10.000 a R$20.000',
											'20_30' => 'Entre R$20.000 a R$30.000',
											// '30_40' => 'Entre R$30.000 e R$40.000',
											// '40_50' => 'Entre R$40.000 e R$50.000',
											// '50_60' => 'Entre R$50.000 e R$60.000',
											// '60_70' => 'Entre R$60.000 e R$70.000',
											// '70_80' => 'Entre R$70.000 e R$80.000',
											// '80_90' => 'Entre R$80.000 e R$90.000',
											'a_30' => 'Acima de R$30.000',
										),
										'label' => [
											'text' => 'Expectativa de investimento*',
											'class' => 'form__label',
										],
										'multiple' => false,
										'disabled' => ['-1'],
										'value' => '-1',
										'class' => 'form__select',
										'data-minimum-results-for-search' => 'Infinity',
									]); ?>
								</div>
							</div>

							<div class="mt-20 mb-40">
								<div class="text-right font-16">Campos obrigatórios*</div>
							</div>

							<div class="form__row">
								<div class="form__group">
									<?php echo $this->Form->button('Solicitar projeto', ['type' => 'submit', 'label' => false, 'class' => 'form__submit btn mx-auto']); ?>
								</div>
							</div>
						</fieldset>
					<!-- </form> -->
					<?php echo $this->Form->end(); ?>
				</div>
				<div class="content">
					<?php echo $this->Html->link('Solicite seu projeto', 'javascript:void(0)', ['class' => 'float-btn btn project-btn']) ?>
				</div>
			</div>
			<?php } ?>
			
			<!-- <section class="my-200">
				<div class="content">
					<div class="newsletter">
						<div class="newsletter__caption">
							<h4 class="font-secondary font-36 mb-20">Newsletter</h4>

							<p class="font-16">Cadastre-se e fique por dentro das novidades e lançamentos.</p>
						</div>
						<div class="newsletter__form">
							<?php echo $this->Form->create(null, ['url' => ['controller' => 'newsletter', 'action' => 'index'], 'class' => 'form form--inline', 'novalidate' => true, 'templates' => [
								'inputContainer' => '{{content}}',
								'submitContainer' => '{{content}}',
							]]); ?>
								<?php echo $this->Form->controls([
									'nome' => ['type' => 'text', 'label' => false, 'class' => 'form__control', 'placeholder' => 'Nome'],
									'email' => ['type' => 'text', 'label' => false, 'class' => 'form__control', 'placeholder' => 'E-mail'],
									'Cadastrar' => ['type' => 'submit', 'class' => 'form__submit btn', 'label' => false]
								], [
									'legend' => false,
									'fieldset' => [
										'class' => 'form__fieldset',
									],
								]) ?>
							<?php echo $this->Form->end(); ?>
						</div>
					</div>
				</div>
			</section> -->

			<section class="sitemap bg-primary">
				<div class="content">
					<div class="sitemap__wrapper">
						<div class="sitemap__column sitemap__column--big">
							<?php echo $this->Html->image('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=', [
								'data-src' => $this->Url->assetUrl('/site/img/logo.jpg'),
								'class' => 'carousel__image img-fluid lazy'
							]); ?>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Sobre</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Institucional', ['controller' => 'sobre', 'action' => 'index', '#' => 'institucional']); ?></li>
								<li class="mb-10"><?php echo $this->Html->link('Sustentabilidade', ['controller' => 'sobre', 'action' => 'index', '#' => 'sustentabilidade']); ?></li>
								<!-- <li class="mb-10"><?php echo $this->Html->link('Tour virtual', ['controller' => 'tourVirtual', 'action' => 'index']); ?></li> -->
							</ul>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Ambientes</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Categorias', ['controller' => 'ambientes', 'action' => 'index']); ?></li>
								<!-- <li class="mb-10"><?php echo $this->Form->postLink('Catálogo', ['controller' => 'catalogo', 'action' => 'index']); ?></li>
								<li class="mb-10"><?php echo $this->Html->link('Acabamentos', ['controller' => 'acabamentos', 'action' => 'index']); ?></li> -->
							</ul>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Onde encontrar</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Encontre uma loja', ['controller' => 'lojas', 'action' => 'index', '#' => 'formulario']); ?></li>
							</ul>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Blog</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Nossos conteúdos', ['controller' => 'blog', 'action' => 'index']); ?></li>
							</ul>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Solicite seu projeto</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Solicitar projeto', ['controller' => 'projetos', 'action' => 'index']); ?></li>
							</ul>
						</div>

						<div class="sitemap__column">
							<h5 class="font-16 mb-20">Contato</h5>

							<ul class="font-16 secondary-color list-style-none">
								<li class="mb-10"><?php echo $this->Html->link('Atendimento', ['controller' => 'atendimento', 'action' => 'index']); ?></li>
								<li class="mb-10"><?php echo $this->Html->link('Seja nosso lojista', 'https://casabrasileiraplanejados.com.br/sejalojista/', ['target' => '_blank']); ?></li>
								<li class="mb-10"><?php echo $this->Html->link('Acompanhe seu pedido', 'https://casabrasileiraplanejados.com.br/unitoken/', ['target' => '_blank']); ?></li>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<div class="sign bg-primary">
				<div class="content">
					<div class="sign__wrapper">
						<div class="social social--footer">
							<ul class="social__list list-style-none">
								<li class="social__item">
									<?php echo $this->Html->link(
										$this->Html->image('/site/img/facebook-2.svg', ['class' => 'social__icon']),
										'https://www.facebook.com/casabrasileiraoficial',
										['escape' => false, 'class' => 'social__btn', 'target' => '_blank']
									); ?>
								</li>
								<li class="social__item">
									<?php echo $this->Html->link(
										$this->Html->image('/site/img/instagram-2.svg', ['class' => 'social__icon']),
										'https://www.instagram.com/casabrasileiraoficial',
										['escape' => false, 'class' => 'social__btn', 'target' => '_blank']
									); ?>
								</li>
								<li class="social__item">
									<?php echo $this->Html->link(
										$this->Html->image('/site/img/youtube-2.svg', ['class' => 'social__icon']),
										'https://www.youtube.com/channel/UC_HyQvDRWYKdPIky-BJXNfw',
										['escape' => false, 'class' => 'social__btn', 'target' => '_blank']
									); ?>
								</li>
							</ul>
							<?php echo $this->Html->link('SAC 0800 721 4104', 'tel:08007214104', ['class' => 'sign__contact font-16']) ?>
						</div>

						<div class="sign__company">
							<?php echo $this->Html->link('Política de privacidade', ['controller' => 'politica', 'action' => 'index'], ['class' => 'font-12']); ?>

							<?php echo $this->Html->link(
								$this->Html->image('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=', [
									'data-src' => $this->Url->assetUrl('/site/img/8poroito.png'),
									'class' => 'lazy',
									'width' => '80',
									'height' => 'auto',
								]),
								'https://8poroito.com.br',
								['escape' => false, 'target' => '_blank']
							); ?>
						</div>
					</div>
				</div>
			</div>
			
			<?php if (is_null($notifyCookie)) { ?>
			<div class="policy-notify">
				<div class="content">
					<div class="policy-notify__wrapper">
						<p class="font-14">Utilizamos cookies para oferecer uma melhor experiência, melhorar o desempenho, analisar como você interage em nosso site e personalizar conteúdo. Ao utilizar este site, você concorda com o uso de cookies. Para mais informações acesse nossa <?php echo $this->Html->link('política de privacidade', ['controller' => 'politica', 'action' => 'index']); ?>.</p>

						<?php echo $this->Html->link('Estou ciente', 'javascript:void(0);', ['class' => 'policy-notify__check btn m-right']); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</footer>

		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MJZSWHT"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

		<?php echo $this->Html->scriptBlock(sprintf(
			'var csrfToken = %s;',
			json_encode($this->request->getAttribute('csrfToken'))
		)); ?>

		<?php echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'); ?>		

		<!-- SITE SCRIPTS -->
		<?php echo $this->Html->script([
			'/site/plugins/jquerymask/jquery.mask.min.js',
			'/site/plugins/select2/select2.full.min.js',	
			'/site/plugins/sweetalert/sweetalert2.min.js',
			// '/site/plugins/lazyload/lazyload.min.js',
			'/site/js/functions.js',		
			'/site/js/select.js',
			'/site/js/form.js',
			'/site/js/mask.js',
		]); ?>



		<!-- PLUGINS SCRIPTS -->
		<?php echo $this->fetch('plugins'); ?>

		<!-- PAGE SCRIPTS -->
		<?php echo $this->fetch('scripts'); ?>
	</body>
</html>