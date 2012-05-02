<!-- Necessary markup, do not remove -->
<div id="mws-sidebar-stitch"></div>
<div id="mws-sidebar-bg"></div>

<!-- Sidebar Wrapper -->
<div id="mws-sidebar">

	<!-- Searchbox -->
	<!-- <div id="mws-searchbox" class="mws-inset">
    	<form action="http://www.malijuthemeshop.com/themes/mws-admin/1.3/typography.html">
        	<input type="text" class="mws-search-input" />
            <input type="submit" class="mws-search-submit" />
        </form>
    </div> -->
    
    <!-- Main Navigation -->
    <div id="mws-navigation">
    	<ul>
        	<li class="active">
                <?php
                    echo $this->Html->link('Dashboard',array('controller'=>'pages','action'=>'home'),array('class'=>'mws-i-24 i-home'));
                ?>
            </li>

            <li>
                <?php echo $this->Html->link('Notícias', '#',array('class'=>'mws-i-24 i-create')) ?>
                <ul>
                    <?php 
                        echo '<li>'.$this->Html->link('Adicionar nova', array('controller'=>'noticias','action' => 'add'),array('class'=>'mws-i-24 i-pencil')).'</li>';
                        echo '<li>'.$this->Html->link('Ver todas', array('controller'=>'noticias','action' => 'index'),array('class'=>'mws-i-24 i-list')).'</li>';
                    ?>
                </ul>
            </li>

            <li>
                <?php echo $this->Html->link('Categorias', '#',array('class'=>'mws-i-24 i-address-book-4')) ?>
                <ul class="closed">
                    <?php 
                        echo '<li>'.$this->Html->link('Adicionar novo', array('controller'=>'categorias','action' => 'add'),array('class'=>'mws-i-24 i-pencil')).'</li>';
                        echo '<li>'.$this->Html->link('Ver todos', array('controller'=>'categorias','action' => 'index'),array('class'=>'mws-i-24 i-list')).'</li>';
                    ?>
                </ul>
            </li>

            <li>
                <?php echo $this->Html->link('Tags', '#',array('class'=>'mws-i-24 i-tag')) ?>
                <ul class="closed">
                    <?php 
                        echo html_entity_decode($this->Html->tag('li' ,$this->Html->link('Adicionar novo', array('controller'=>'tags','action' => 'add'),array('class'=>'mws-i-24 i-pencil')) ));
                        echo '<li>'.$this->Html->link('Ver todos', array('controller'=>'tags','action' => 'index'),array('class'=>'mws-i-24 i-list')).'</li>';
                    ?>
                </ul>
            </li>

        </ul>
    </div>            
</div>