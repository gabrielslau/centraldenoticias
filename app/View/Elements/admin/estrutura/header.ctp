<div id="mws-header" class="clearfix">

    <!-- Logo Container -->
    <div id="mws-logo-container">
    
        <!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        <div id="mws-logo-wrap">
            <?php echo $this->Html->image('admin/logomarca-professionalworldwide.gif',array('alt'=>'mws admin')) ?>
        </div>
    </div>
    
    <!-- User Tools (notifications, logout, profile, change password) -->
    <div id="mws-user-tools" class="clearfix">
        
        <!-- User Information and functions section -->
        <div id="mws-user-info" class="mws-inset">
        
            <!-- User Photo -->
            <div id="mws-user-photo">
                <?php echo $this->Html->image('admin/core/userdefault-30.gif',array('alt'=>'Avatar')) ?>
            </div>
            
            <!-- Username and Functions -->
            <div id="mws-user-functions">
                <div id="mws-username">
                    <cake:nocache>
                    Olá, <?php 
                        echo AuthComponent::user('nome'); 
                    ?>
                    </cake:nocache>
                </div>
                <ul>
                    <!-- <li><a href="#">Profile</a></li> -->
                    <!-- <li><a href="#">Change Password</a></li> -->
                    <?php 
                        // echo '<li>'.$this->Html->link('Voltar para o site','/').'</li>';
                        echo '<li>'.$this->Html->link('Sair',array('controller'=>'users','action'=>'logout','admin'=>true)).'</li>';
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div><!-- end #header -->