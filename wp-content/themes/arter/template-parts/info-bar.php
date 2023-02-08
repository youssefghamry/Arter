<?php

$vcard_image = get_field( 'vcard_image', 'option' );
$vcard_full_image = get_field( 'vcard_full_image', 'option' );
$vcard_name = get_field( 'vcard_name', 'option' );
$vcard_live = get_field( 'vcard_live', 'option' );
$vcard_short_desc = get_field( 'vcard_short_desc', 'option' );
$vcard_available = get_field( 'vcard_available', 'option' );
$vcard_info = get_field( 'vcard_info', 'option' );
$vcard_skills = get_field( 'vcard_skills', 'option' );
$vcard_buttons = get_field( 'vcard_buttons', 'option' );
$social_links = get_field( 'social_links', 'option' );
$theme_lightbox = get_field( 'portfolio_lightbox_disable', 'option' );

?>

<!-- info bar -->
<div class="art-info-bar">

  <!-- menu bar frame -->
  <div class="art-info-bar-frame">

    <!-- info bar header -->
    <div class="art-info-bar-header">
      <!-- info bar button -->
      <a class="art-info-bar-btn">
        <!-- icon -->
        <i class="fas fa-ellipsis-v"></i>
      </a>
      <!-- info bar button end -->
    </div>
    <!-- info bar header end -->

    <!-- info bar header -->
    <div class="art-header">
      <!-- avatar -->
      <div class="art-avatar">
        <a<?php if ( ! $theme_lightbox ) : ?> data-magnific-image<?php endif; ?> data-no-swup href="<?php echo esc_url( $vcard_full_image ); ?>" class="art-avatar-curtain">
          <img src="<?php echo esc_url( $vcard_image ); ?>" alt="avatar">
          <i class="fas fa-expand"></i>
        </a>
        <!-- available -->
        <div class="art-lamp-light<?php if ( ! $vcard_available ) : ?> art-not-available<?php endif; ?>">
          <!-- add class 'art-not-available' if not available-->
          <div class="art-available-lamp" title="<?php echo esc_attr( $vcard_live ); ?>"></div>
        </div>
      </div>
      <!-- avatar end -->
      <!-- name -->
      <h5 class="art-name mb-10"><a href="<?php echo esc_url( home_url() ); ?>"><?php echo esc_html( $vcard_name ); ?></a></h5>
      <!-- post -->
      <div class="art-sm-text"><?php echo wp_kses_post( $vcard_short_desc ); ?></div>
    </div>
    <!-- info bar header end -->

    <!-- scroll frame -->
    <div id="scrollbar2" class="art-scroll-frame">

      <?php if ( $vcard_info ) : ?>
      <!-- info bar about -->
      <div class="art-table p-15-15">
        <!-- about text -->
        <ul>
          <?php foreach ( $vcard_info as $item ) : ?>
          <li>
            <h6><?php echo esc_html( $item['label'] ); ?></h6><span><?php echo esc_html( $item['value'] ); ?></span>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!-- info bar about end -->

      <!-- divider -->
      <div class="art-ls-divider"></div>
      <?php endif; ?>
	  
	  <?php if ( $vcard_skills ) : ?>
      <?php $i=0; foreach ( $vcard_skills as $skill ) : $i++; ?>
      <?php if ( $skill['type'] == 'circles' && $skill['items'] ) : ?>
	  <?php if ( $skill['title'] ) : ?><h5 class="art-title-h"><?php echo wp_kses_post( $skill['title'] ); ?></h5><?php endif; ?>
      <!-- language skills -->
      <div class="art-lang-skills p-30-15">
        <?php $j=0; foreach ( $skill['items'] as $item ) : $j++; ?>
        <!-- skill -->
        <div class="art-lang-skills-item">
          <div id="circleprog<?php echo esc_attr( $i ); ?>-<?php echo esc_attr( $j ); ?>" data-type="circles" data-value="<?php echo esc_attr( $item['value'] ); ?>" class="art-cirkle-progress art-skills-progress"></div>
          <!-- title -->
          <h6><?php echo esc_html( $item['label'] ); ?></h6>
        </div>
        <!-- skill end -->
        <?php endforeach; ?>
      </div>
      <!-- language skills end -->

      <!-- divider -->
      <div class="art-ls-divider"></div>
      <?php endif; ?>

      <?php if ( $skill['type'] == 'progress' && $skill['items'] ) : ?>
      <?php if ( $skill['title'] ) : ?><h5 class="art-title-h"><?php echo wp_kses_post( $skill['title'] ); ?></h5><?php endif; ?>
	  <!-- hard skills -->
      <div class="art-hard-skills p-30-15">
        <?php $j=0; foreach ( $skill['items'] as $item ) : $j++; ?>
        <!-- skill -->
        <div class="art-hard-skills-item">
          <div class="art-skill-heading">
            <!-- title -->
            <h6><?php echo esc_html( $item['label'] ); ?></h6>
          </div>
          <!-- progressbar frame -->
          <div class="art-line-progress">
            <!-- progressbar -->
            <div id="lineprog<?php echo esc_attr( $i ); ?>-<?php echo esc_attr( $j ); ?>" data-type="progress" data-value="<?php echo esc_attr( $item['value'] ); ?>" class="art-skills-progress"></div>
          </div>
          <!-- progressbar frame end -->
        </div>
        <!-- skill end -->
        <?php endforeach; ?>
      </div>
      <!-- language skills end -->

      <!-- divider -->
      <div class="art-ls-divider"></div>
      <?php endif; ?>

      <?php if ( $skill['type'] == 'list' && $skill['items'] ) : ?>
      <?php if ( $skill['title'] ) : ?><h5 class="art-title-h"><?php echo wp_kses_post( $skill['title'] ); ?></h5><?php endif; ?>
	  <!-- knowledge list -->
      <ul class="art-knowledge-list p-15-0">
        <?php $j=0; foreach ( $skill['items'] as $item ) : $j++; ?>
        <!-- list item -->
		  <li><i class="<?php echo esc_attr( $item['icon'] ); ?>"></i><?php echo esc_html( $item['label'] ); ?></li>
        <?php endforeach; ?>
      </ul>
      <!-- knowledge list end -->

      <!-- divider -->
      <div class="art-ls-divider"></div>
      <?php endif; ?>
      <?php endforeach; ?>
	  <?php endif; ?>

      <?php if ( $vcard_buttons ) : ?>
      <!-- links frame -->
      <div class="art-links-frame p-15-15">
        <?php foreach ( $vcard_buttons as $button ) : ?>
        <!-- download cv button -->
        <a href="<?php echo esc_url( $button['url'] ); ?>" class="art-link"<?php if ( $button['attributes']['download'] ) : ?> download<?php endif; ?><?php if ( $button['attributes']['new_window'] ) : ?> target="_blank"<?php endif; ?>><?php echo esc_html( $button['label'] ); ?> <i class="<?php echo esc_attr( $button['icon'] ); ?>"></i></a>
        <?php endforeach; ?>
      </div>
      <!-- links frame end -->
      <?php endif; ?>
    </div>
    <!-- scroll frame end -->

    <?php if ( $social_links ) : ?>
    <!-- sidebar social -->
    <div class="art-ls-social">
      <?php foreach ( $social_links as $link ) : ?>
      <!-- social link -->
      <a href="<?php echo esc_url( $link['url'] ); ?>" target="_blank"><i class="<?php echo esc_attr( $link['icon'] ); ?>"></i></a>
      <!-- social link -->
      <?php endforeach; ?>
    </div>
    <!-- sidebar social end -->
    <?php endif; ?>
  </div>
  <!-- menu bar frame end -->

</div>
<!-- info bar end -->