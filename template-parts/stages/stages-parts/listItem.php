<div class="listItem <?= esc_attr( $size ); ?>">
	<?php
		$tag   = get_field( 'artist-page' ) === 'yes' ? 'a'   : 'div';
		$href  = $tag === 'a' ? ' href="' . esc_url( $link ) . '"' : '';
		$label = get_field( 'artist-label' );
		$ctry  = get_field( 'artist-coutry' );

		echo "<{$tag}{$href}>";
	?>

		<h3><?= esc_html( $title ); ?></h3>

		<p>
			<?= $label ? esc_html( $label ) : ''; ?>
			<?php if ( $ctry ) : ?>
				<span>(<?= esc_html( $country ); ?>)</span>
			<?php endif; ?>
		</p>

	<?php
		echo "</{$tag}>";

		edit_post_link( 'E' ); // quick inline tweak link for admins
	?>
</div>
