<div class="panel <?php echo $this->Inject->getPanelClass($inject); ?>">
	<div class="panel-heading">
		<h4 class="panel-title">
			<a 
				data-toggle="collapse" 
				href="#inject<?php echo $inject['Inject']['id']; ?>" 
				class="<?php echo $this->Inject->completedOrExpired($inject) ? 'collapsed' : ''; ?>"
			>
				<?php echo $inject['Inject']['title']; ?>
			</a>
		</h4>
	</div>

	<div id="inject<?php echo $inject['Inject']['id']; ?>" class="panel-collapse collapse<?php echo $this->Inject->completedOrExpired($inject) ? '' : ' in'; ?>">
		<div class="panel-body">
			<table class="table">
				<tbody>
					<tr>
						<td>
							<?php echo $inject['Inject']['description']; ?>
						</td>

						<td class="text-right text-nowrap">
							<?php if ( $this->Inject->completed($inject) ): ?>
							
							<p><button class="btn btn-xs btn-success">COMPLETED</button></p>

							<?php elseif ( $this->Inject->expired($inject) ): ?>

							<p><button class="btn btn-xs btn-danger">EXPIRED</button></p>

							<?php else: ?>

							<?php if ( $inject['Inject']['hints_enabled'] ): ?>
							<p>
								<button 
									class="btn btn-xs btn-info" 
									data-toggle="modal" 
									data-target="#hintModal" 
									data-inject-id="<?php echo $inject['Inject']['id']; ?>"
								>
									HINTS AVAILABLE
								</button>
							</p>
							<?php endif; ?>

							<p>
								<button 
									class="btn btn-xs btn-warning" 
									data-toggle="modal" 
									data-target="#helpModal" 
									data-inject-id="<?php echo $inject['Inject']['id']; ?>"
									data-inject-name="<?php echo $inject['Inject']['title']; ?>"
								>
									REQUEST HELP
								</button>
							</p>

							<?php endif; ?>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<?php echo $this->fetch('inject_submit'); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="panel-footer">
			<?php if ( $inject['Inject']['time_start'] > 0 ): ?>
			<p><strong>Inject Start</strong>: <?php echo date('n/j \a\t g:iA', $inject['Inject']['time_start']); ?></p>
			<?php endif; ?>

			<?php if ( $inject['Inject']['time_end'] > 0 ): ?>
			<p><strong>Inject End</strong>: <?php echo date('n/j \a\t g:iA', $inject['Inject']['time_end']); ?></p>
			<?php endif; ?>
			
			<?php if ( $this->Inject->completed($inject) ): ?>
			<p><strong>Completed By</strong>: <?php echo $inject['User']['username']; ?> at <?php echo date('g:iA', $inject['CompletedInject']['time']); ?></p>
			<?php endif; ?>
		</div>
	</div>
</div>