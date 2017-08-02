<?php

	if (!class_exists("DOPPlayerAdmin")) 
	{
		class DOPPlayerAdmin 
		{
			var $adminOptionsName = "DOPPlayerAdminOptions";
			
			//class constructor
			function DOPPlayerAdmin() 
			{
			}
			
			//Returns an array of admin options
			function getAdminOptions() 
			{
				$DOPPAdminOptions = array('dopp_width' => '640','dopp_height' => '510','dopp_bgColor' => '000000','dopp_bgAlpha' => '100','dopp_cpBgColor' => '000000','dopp_cpBtnBgColor' => '000000','dopp_cpBtnOutlineColor' => 'FFFFFF');
				$DOPPOptions = get_option($this->adminOptionsName);
				if (!empty($DOPPOptions)) 
				{
					foreach ($DOPPOptions as $key => $option)
						$DOPPAdminOptions[$key] = $option;
				}				
				
				update_option($this->adminOptionsName, $DOPPAdminOptions);
				return $DOPPAdminOptions;
			}
						
			function init() 
			{
				$this->getAdminOptions();
			}
			
			function theWidth() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_width'];
			}
			
			function theHeight() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_height'];
			}
			
			function theBgColor() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_bgColor'];
			}
			
			function theBgAlpha() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_bgAlpha'];
			}
			
			function theCpBgColor() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_cpBgColor'];
			}
			
			function theCpBtnBgColor() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_cpBtnBgColor'];
			}
			
			function theCpBtnOutlineColor() 
			{
				$DOPPOptions = $this->getAdminOptions();
				return $DOPPOptions['dopp_cpBtnOutlineColor'];
			}
							
			//Prints out the admin page
			function printAdminPage() 
			{
				$DOPPOptions = $this->getAdminOptions();
										
				if (isset($_POST['update_DOPPlayerAdminSettings'])) 
				{
					if (isset($_POST['DOPPWidth'])) 
					{
						$DOPPOptions['dopp_width'] = $_POST['DOPPWidth'];
					}
					if (isset($_POST['DOPPHeight'])) 
					{
						$DOPPOptions['dopp_height'] = $_POST['DOPPHeight'];
					} 
					if (isset($_POST['DOPPBgColor'])) 
					{
						$DOPPOptions['dopp_bgColor'] = $_POST['DOPPBgColor'];
					}	
					if (isset($_POST['dopp_DOPPAddContent'])) 
					{
						$DOPPOptions['dopp_bgAlpha'] = $_POST['DOPPBgAlpha'];
					}	
					if (isset($_POST['DOPPCpBgColor'])) 
					{
						$DOPPOptions['dopp_cpBgColor'] = $_POST['DOPPCpBgColor'];
					}	
					if (isset($_POST['DOPPCpBtnBgColor'])) 
					{
						$DOPPOptions['dopp_cpBtnBgColor'] = $_POST['DOPPCpBtnBgColor'];
					}
					if (isset($_POST['DOPPCpBtnOutlineColor'])) 
					{
						$DOPPOptions['dopp_cpBtnOutlineColor'] = $_POST['DOPPCpBtnOutlineColor'];
					}
					
					update_option($this->adminOptionsName, $DOPPOptions);
						
?>
					<div class="updated"><p><strong><?php _e("Settings Updated.", "DOPPlayerAdmin");?></strong></p></div>
<?php
				} 
?>
	
    <div class=wrap>
		<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <h2>DOP Player Options</h2>
            	<h3>Set player width (default width: 640;)</h3>
                    <input type="text" name="DOPPWidth" value="<?php _e($DOPPOptions['dopp_width'], 'DOPPlayerAdmin') ?>" />
                <h3>Set player height (default height: 510;)</h3>
                    <input type="text" name="DOPPHeight" value="<?php _e($DOPPOptions['dopp_height'], 'DOPPlayerAdmin') ?>" />   
                <h3>Set background color (add the hexadecimal code; ex: FF00FF; default color: 000000;)</h3>
                    <input type="text" name="DOPPBgColor" value="<?php _e($DOPPOptions['dopp_bgColor'], 'DOPPlayerAdmin') ?>" />
                <h3>Set background alpha (add a value between 0 and 100; default value: 100;)</h3>
                    <input type="text" name="DOPPBgAlpha" value="<?php _e($DOPPOptions['dopp_bgAlpha'], 'DOPPlayerAdmin') ?>" />
                <h3>Set control panel background color (add the hexadecimal code; ex: FF00FF; default color: 000000;)</h3>
                    <input type="text" name="DOPPCpBgColor" value="<?php _e($DOPPOptions['dopp_cpBgColor'], 'DOPPlayerAdmin') ?>" />
                <h3>Set buttons background color (add the hexadecimal code; ex: FF00FF; default color: 000000;)</h3>
                    <input type="text" name="DOPPCpBtnBgColor" value="<?php _e($DOPPOptions['dopp_cpBtnBgColor'], 'DOPPlayerAdmin') ?>" />                    
                <h3>Set buttons outline color (add the hexadecimal code; ex: FF00FF; default color: FFFFFF;)</h3>
                    <input type="text" name="DOPPCpBtnOutlineColor" value="<?php _e($DOPPOptions['dopp_cpBtnOutlineColor'], 'DOPPlayerAdmin') ?>" />
                
               	<h3><br />Warning: Please make shure you entered the correct data. Your data isn't validated by the admin panel.</h3>    
                   
                                            
           		<div class="submit">
            		<input type="submit" name="update_DOPPlayerAdminSettings" value="<?php _e('Update Options', 'DOPPlayerAdmin') ?>" />
                </div>
        </form>
	</div>

<?php
			}
		}

	}

	if (class_exists("DOPPlayerAdmin")) 
	{
		$dopp_pluginSeries = new DOPPlayerAdmin();
	}
	
	//Initialize the admin panel
	if (!function_exists("DOPPlayerAdmin_ap")) 
	{
		function DOPPlayerAdmin_ap() 
		{
			global $dopp_pluginSeries;
			
			if (!isset($dopp_pluginSeries)) 
			{
				return;
			}
			if (function_exists('add_options_page')) 
			{
				add_options_page('DOP Player', 'DOP Player', 9, basename(__FILE__), array(&$dopp_pluginSeries, 'printAdminPage'));
			}
		}	
	}
	
	//Actions and Filters	
	if (isset($dopp_pluginSeries)) 
	{
		//Actions
		add_action('admin_menu', 'DOPPlayerAdmin_ap');
		add_action('../dop-player.php',  array(&$dopp_pluginSeries, 'init'));
	}

?>