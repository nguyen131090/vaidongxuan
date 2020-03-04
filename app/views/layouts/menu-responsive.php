<ul class="nav navbar-nav p-0 m-0">
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">Nos destinations</a>
      <ul class="dropdown-menu">
        <li><a href="/vietnam">Vietnam</a></li>
        <li><a href="/laos">Laos</a></li>
        <li><a href="/cambodge">Cambodge</a></li>
        <li><a href="/birmanie">Birmanie</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="/formules">Formules d'Amica</a>
      <ul class="dropdown-menu">
        <? foreach ($this->context->excluMenu as $v) : ?>
          <li><a href="/<?=$v->slug;?>"><?=$v->title; ?></a></li>
        <? endforeach; ?>
      </ul>
    </li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="/voyage">Idées de voyage</a>
      <ul class="dropdown-menu">
        <? foreach ($this->context->ideesMenu as $v) : ?>
          <li><a  class="ui-link" href="/<?=$v->slug;?>"><?=$v->title; ?></a></li>
        <? endforeach; ?>
        
      </ul>
    </li>
    <li><a href="/a-propos-de-nous">À propos de nous</a></li> 
</ul>