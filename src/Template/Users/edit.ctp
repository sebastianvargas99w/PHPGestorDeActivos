<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<head>
  <style>
        .btn-primary {
          color: #fff;
          background-color: #0099FF;
          border-color: #0099FF;
          float: right;
          margin-left: 10px;
        }

        .btn-default {
          color: #000;
          background-color: #7DC7EF;
          border-top-right-radius: 5px;
          border-bottom-right-radius: 5px;
        }

        label {
          text-align:left;
          margin-right: 10px;

        }

        .sameLine{
          display: flex;
          justify-content: space-between;
          border-color: transparent;
        }

  </style>
</head>

<body>
<div class="users form large-9 medium-8 columns content">
  <?= $this->Form->create($user) ?>
  <fieldset>
    <legend><?= __('Modificar Usuario') ?></legend>
    <br>
      <div class="form-control sameLine" >
        <div class="row">
          <label> <b>Nombre:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('nombre', ['class'=>'form-control col-md-6']); ?>
        </div>

        <div class="row">
          <label> <b>Primer Apellido:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('apellido1', ['class'=>'form-control col-md-6']); ?>
        </div>

        <div class="row">
          <label> <b>Segundo Apellido:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('apellido2', ['class'=>'form-control col-md-6']); ?>
        </div>
      </div>
      <br>

      <div class="form-control sameLine" >
        <div class="row">
          <label> <b>Cédula:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('id', ['class'=>'form-control col-md-6', 'disabled']); ?>
        </div>

        <div class="row">
          <label> <b>Rol:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->select('id_rol', $roles, array('empty' => '-- Seleccione Rol --', 'class' => 'form-control col-md-9')); ?>
        </div>

        <div class="row">
          <label> <b>Estado:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->select('account_status', array('1' => 'Activo', '0' => 'Inoperante'), array('empty' => '-- Seleccione Estado --', 'class' => 'form-control col-md-8')); ?>
        </div>

      </div>
      <br>

      <label> <b>Correo:</b><b style="color:red;"></b> </label>
      <?php echo $this->Form->imput('correo', ['class'=>'form-control col-md-6']); ?>
      <br>

      <div class="form-control sameLine" >
        <div class="row">
          <label> <b>Usuario:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('username', ['class'=>'form-control col-md-6']); ?>
        </div>

        <div class="row">
          <label> <b>Contraseña:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('password', ['type'=> 'password', 'class'=>'form-control col-md-6', 'value'=> '']); ?>
        </div>

        <div class="row">
          <label> <b>Confirmar Contraseña:</b><b style="color:red;"></b> </label>
          <?php echo $this->Form->imput('password2', ['type'=> 'password', 'class'=>'form-control col-md-6', 'value'=> '']); ?>
        </div>
      </div>
      <br>
  </fieldset>
</div>
<br>

  <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-primary']) ?>
  <?= $this->Form->button(__('Aceptar'), ['class' => 'btn btn-primary']) ?>

<?= $this->Form->end(); ?>

</body>
