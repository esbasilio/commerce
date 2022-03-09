 @include('common.modalHead')
            <div class="row">
                <div class="col-sm-12 col-md-8">
                 <div class="form-group">
                  <label>Usuario</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="name" class="form-control" placeholder="ej: luis" >
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('name') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                 <div class="form-group">
                  <label >Teléfono</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="phone" maxlength="10" class="form-control" placeholder="ej: 351-0000000" >
                    <div class="form-control-position">
                      <i class="ft-phone"></i>
                    </div>
                  </div>
                  @error('phone') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                 <div class="form-group">
                  <label >Email</label>
                  <div class="position-relative has-icon-left">
                    <input type="email" wire:model.lazy="email" class="form-control" placeholder="ej: correo@gmail.com" >
                    <div class="form-control-position">
                      <i class="la la-envelope"></i>
                    </div>
                  </div>
                  @error('email') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @if($selected_id == 0)
              <div class="col-sm-12 col-md-6">
                 <div class="form-group">
                  <label >Contraseña</label>
                  <div class="position-relative has-icon-left">
                    <input type="password" wire:model.lazy="password" class="form-control" autocomplete="new-password">
                    <div class="form-control-position">
                      <i class="la la-key"></i>
                    </div>
                  </div>
                  @error('password') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif

              <div class="col-sm-12 col-md-6">
                 <div class="form-group">
                  <label >Estado</label>
                    <select wire:model.lazy="status" class="form-control">
                      <option value="Elegir" selected>Elegir</option>
                      <option value="Activo">Con Acceso</option>
                      <option value="Bloqueado">Sin Acceso</option>
                    </select>
                  @error('status') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
               <div class="col-sm-12 col-md-6">
                 <div class="form-group">
                  <label >Asignar Rol</label>
                    <select wire:model.lazy="profile" class="form-control">
                     @foreach($roles as $role)
                     <option value="{{$role->name}}">{{$role->name}}</option>
                     @endforeach
                    </select>
                  @error('profile') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>


              @if(isset($entity_fields['name']))
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label>Nombre</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_fields.name" class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @if(isset($entity_fields['last_name']))
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label>Apellido</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_fields.last_name" class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                </div>
              </div>
              @endif

              @if(isset($entity_fields['business_name']))
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label>Razon social</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_fields.business_name" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_fields.business_name') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif

              @if(isset($entity_fields['branch_number']))
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label>Sucursal</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_fields.branch_number" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_fields.branch_number') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif

              @if(isset($entity_address['id']))
              <div class="col-sm-12 col-md-10">
              ______________________________________________________________________________
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label>Calle</label>
                  <div class="position-relative has-icon-left">
                    <input type="hidden" wire:model.lazy="entity_address.id">
                    <input type="text" wire:model.lazy="entity_address.address" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_address.address') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label>Numero</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_address.address_number" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_address.address_number') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label>Referencia</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_address.reference" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_address.reference') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif


              @if(isset($entity_identification['id']))
              <div class="col-sm-12 col-md-10">
              ______________________________________________________________________________
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label>DNI</label>
                  <div class="position-relative has-icon-left">
                    <input type="hidden" wire:model.lazy="entity_identification.id">
                    <input type="text" wire:model.lazy="entity_identification.number" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_identification.number') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-5">
                <div class="form-group">
                  <label>CBU</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_identification.cbu" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_identification.cbu') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label>CUIT</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_identification.cuit" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_identification.cuit') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label>CUIL</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_identification.cuil" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_identification.cuil') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif


              @if(isset($entity_contact['id']))
              <div class="col-sm-12 col-md-10">
              ______________________________________________________________________________
              </div>
              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label>Telefono</label>
                  <div class="position-relative has-icon-left">
                    <input type="hidden" wire:model.lazy="entity_contact.id">
                    <input type="text" wire:model.lazy="entity_contact.phone" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_contact.phone') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-3">
                <div class="form-group">
                  <label>Fax</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_contact.fax" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_contact.fax') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_contact.email" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_contact.email') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>

              <div class="col-sm-12">
                <div class="form-group">
                  <label>Web</label>
                  <div class="position-relative has-icon-left">
                    <input type="text" wire:model.lazy="entity_contact.web_site" 
                    class="form-control" placeholder="">
                    <div class="form-control-position">
                      <i class="ft-edit-2"></i>
                    </div>
                  </div>
                  @error('entity_contact.web_site') <span class="text-danger er">{{ $message }}</span> @enderror
                </div>
              </div>
              @endif

              <div class="col-sm-12 col-md-10">
              ______________________________________________________________________________
              </div>

              <div class="col-sm-12">
                 <div class="form-group">
                  <label>Imágen de perfil</label>
                    <input type="file"  wire:model="image" accept="image/x-png, image/gif, image/jpeg"  class="form-control">
                  @error('image') <span class="error">{{ $message }}</span> @enderror
                </div>
              </div>

            </div>

@include('common.modalFooter')
