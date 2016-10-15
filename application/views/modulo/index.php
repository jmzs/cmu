<div class="modal fade" id="mod-form" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title nm">Registrar Nuevo Modulo</h4>
			</div>
			<div class="modal-body">
				<form id="form" class="form-horizontal">
					<input type="hidden" name="modulo_id" class="oculto">
					<div class="form-group">
						<label class="col-md-3 control-label">Nombre</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="modulo_nombre" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Icono</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="modulo_icono" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Url</label>
						<div class="col-md-8">
							<input type="text" class="form-control" name="modulo_url" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Modulo Padre</label>
						<div class="col-md-8" id="modulo_padre"></div>
					</div>
					<div class="row">
						<div class="col-md-offset-7 col-md-2">
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						</div>
						<div class="col-md-2">
							<button type="submit" class="btn btn-primary">Guardar</button>
						</div>
					</div>
					<!-- <div class="form-group">

					</div> -->
				</form>
			</div>

		</div>
	</div>
</div>