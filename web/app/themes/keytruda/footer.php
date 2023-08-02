		</main>
		
		<?php
		$copy_text = get_field('footer_copy_text', 'options');
		$phone_info = get_field('f_phone_info', 'options');
		$phone = get_field('f_phone', 'options');
		$phone_converted = str_replace(' ', '', $phone);
		$phone_converted = str_replace('-', '', $phone_converted);
		$phone_converted = preg_replace('/[^A-Za-z0-9\-]/', '', $phone_converted);
		$safety_title = get_field('safety_title', 'options');
		$add_text = get_field('add_text', 'options');
		$safety_text = get_field('safety_text', 'options');
		?>
		
		<footer id="footer">
			<div class="content-wrapper">
				<div class="col left">
					<?php if(function_exists('pll_the_languages')){ ?>
						<ul class="lang-switcher desktop-hide"><?php pll_the_languages($args); ?></ul>
					<?php } ?>
					<img class="merc-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/Merck_Logo.svg" alt="Merck">
					<?php if ($copy_text) echo '<p>' . $copy_text . '</p>' ?>
				</div>
				<div class="col center">
					<ul class="footer-nav">
						<?php site_menu('Footer Menu'); ?>
					</ul>
					<?php if ($phone_info || $phone) { ?>
						<div class="phone-section">
							<?php if ($phone_info) echo '<p>' . $phone_info . '</p>' ?>
							<?php if ($phone) echo '<a href="tel:' . $phone_converted . '" class="phone"><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 22.621l-3.521-6.795c-.008.004-1.974.97-2.064 1.011-2.24 1.086-6.799-7.82-4.609-8.994l2.083-1.026-3.493-6.817-2.106 1.039c-7.202 3.755 4.233 25.982 11.6 22.615.121-.055 2.102-1.029 2.11-1.033z"/></svg></span>' . $phone . '</a>' ?>
						</div>
					<?php } ?>
					<?php if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') : ?>
						<span class="key">CA-KEY-01117</span>
					<?php else : ?>
						<span class="key">CA-KEY-00805</span>
					<?php endif; ?>
					<div class="assistive">
						<img tabindex="0" src="<?php echo get_template_directory_uri() ?>/assets/img/eA_Icon.svg" class="attachment-assistive size-assistive" alt="Assistive Download" loading="lazy" width="209" height="78">
						<div class="form-box">
							<div class="form-placer">
								<form action="https://download.essentialaccessibility.com/EABrowser/setup.exe" data-download-button-form="installATform" data-download-url-android="https://download.essentialaccessibility.com/Android/EssentialAccessibility.apk" data-download-url-macos="https://download.essentialaccessibility.com/macOS/eSSENTIAL%20Accessibility.pkg" data-download-url-windows="https://download.essentialaccessibility.com/EABrowser/setup.exe">
									<button tabindex="0" type="submit" class="install-free-at disable-download-button" onclick="dataLayer.push({'event': 'myEvent','myEventAction': 'Install Free Assistive Technology'});">Install
										Free Assistive Technology</button>
									<div class="terms-of-use"><input type="checkbox" required="" id="terms_of_use_header" oninvalid="this.setCustomValidity('To install, you must agree to our terms of use before you can install.')" onchange="this.setCustomValidity('')"><label for="terms_of_use_header">By
											installing, I agree to <a href="https://www.essentialaccessibility.com/eula" target="opens in a new window" target="_blank" rel="noopener" aria-label="By installing, I agree to essentialaccessibility terms" tabindex="57">Terms of Use</a>.</label></div>
								</form>
								<span class="close" tabindex="0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
										<path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
									</svg></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col right">
					<?php if(function_exists('pll_the_languages')){ ?>
						<ul class="lang-switcher mobile-hide"><?php pll_the_languages($args); ?></ul>
					<?php } ?>
					<?php if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') : ?>
						<button id="ot-sdk-btn" class="cookies-config mgbutton ot-sdk-show-settings">Cookie Preferences</button>
					<?php else : ?>
						<button id="ot-sdk-btn" class="cookies-config mgbutton ot-sdk-show-settings">Préférences de cookies</button>
					<?php endif; ?>
					<?php /*
						<button>Cookie Preferences</button>
					*/ ?>

					<?php if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'en') : ?>
						<div class="logos">
							<img class="i-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/IMC.svg" alt="Innovative Medicines Canada">
							<img class="paab-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/PAAB_logo.png" alt="Reviewed by PAAB">
						</div>
					<?php elseif (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE == 'fr') : ?>
						<div class="logos">
							<img class="i-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/IMC_FR.svg" alt="Medicaments Novateurs Canada">
							<img class="paab-logo" src="<?php echo get_template_directory_uri() ?>/assets/img/ccpp_logo.png" alt="Revise par CCPP">
						</div>
					<?php endif; ?>
					<a class="all-to-top" tabindex="0" href="#branding">Back to top</a>
				</div>
			</div>
		</footer>
		</div>
		<?php if ($safety_title || $safety_text || $add_text) { ?>
			<a class="safety-p" data-options='{"touch" : false}' data-fancybox data-src="#safety" href="javascript:;">Safety</a>
			<div class="safety-popup" id="safety">
				<?php if ($safety_title) echo '<div class="heading"><h3>' . $safety_title . '</h3></div>'; ?>
				<?php if ($safety_text || $add_text) {
					echo '<div class="hold">';
					echo '<div class="hold-inner">';
					if ($safety_text) echo '<div class="text-wrap">' . $safety_text . '</div>';
					if ($add_text) echo '<div class="add-text">' . $add_text . '</div>';
					echo '</div>';
					echo '</div>';
				} ?>
			</div>
		<?php } ?>
		<?php wp_footer(); ?>
		</body>

		</html>