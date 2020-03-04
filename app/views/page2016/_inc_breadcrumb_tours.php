<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <a itemprop="item" href="/"><span itemprop="name">Accueil</span></a> <span> &gt; </span>
        <meta itemprop="position" content="1" />
    </div>
<!--    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <a  itemprop="item" href="/destinations"><span itemprop="name">Destinations</span></a>
        <meta itemprop="position" content="2" />
    </div>
    <span> &gt; </span>-->
    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <a  itemprop="item" href="<?=DIR.SEG1 ?>"><span itemprop="name">Voyage au <?=ucfirst(SEG1)?></span></a> <span> &gt; </span>
        <meta itemprop="position" content="2" />
    </div>
    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <a  itemprop="item" href="<?=DIR.SEG1 ?>/itineraire"><span itemprop="name"> Circuits au <?=ucfirst(SEG1)?></span></a> <span> &gt; </span>
        <meta itemprop="position" content="3" />
    </div>

    <div class="item" itemprop="itemListElement" itemscope
         itemtype="http://schema.org/ListItem">
        <span  itemprop="item" ><span itemprop="name"><?= isset($this->context->entry->model->seo->breadcrumb) && $this->context->entry->model->seo->breadcrumb ? $this->context->entry->model->seo->breadcrumb : $this->context->entry->title?></span></span>
        <meta itemprop="position" content="4" />
    </div>
</div>