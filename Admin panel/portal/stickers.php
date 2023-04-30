<?php 
if(isset($_SESSION[PRE_FIX.'id']))
{       
    
        $url=$baseurl . 'showStickers';
        $data =array(
            "starting_point" => "0"
        );
        
        $json_data=@curl_request($data,$url);
        
        $allusers = [];
        if ($json_data['code'] == 200) {
            $allusers = $json_data['msg'];
        }
        
        ?>

        <div class="qr-content">
            <div class="qr-page-content">
                <div class="qr-page zeropadding">
                    <div class="qr-content-area">
                        <div class="qr-row">
                            <div class="qr-el">

                                <div class="page-title">
                                    <h2>All Stickers</h2>
                                    <div class="head-area">
                                    </div>
                                </div>
                                
                                <div class="right" style="padding: 10px 0;">
                                    <button onclick="addSticker();" class="com-button com-submit-button com-button--large com-button--default">
                                        <div class="com-submit-button__content"><span>Add Sticker</span></div>
                                    </button>
                                </div>
                                <!--start of datatable here-->


                                <table id="table_view" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th width="180px">Name</th>
                                            <th>Preview</th>
                                            <th>Type</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php 
                                        if(is_array($json_data['msg']) || is_object($json_data['msg']))
                                        {
                                            foreach ($json_data['msg'] as $singleRow): 
                                                   
                                                $local=strpos($singleRow['Sticker']['image'],'webroot');
	                                            if($local==true)
                                                {
                                                    $fileName=$imagebaseurl.$singleRow['Sticker']['image'];
                                                }
                                                else
                                                {
                                                    $fileName=$singleRow['Sticker']['image'];
                                                } 
                                                ?>
                                                    <tr>
                                                        <td><?php echo $singleRow['Sticker']['id']; ?></td>
                                                        <td><?php echo $singleRow['Sticker']['title']; ?></td>
                                                        
                                                        <td>
                                                            <a href="<?php echo $fileName; ?>">
                                                                <img src="<?php echo $fileName; ?>" atl="stickers" width="30px">
                                                            </a>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                if($singleRow['Sticker']['type']=="0")
                                                                {
                                                                    echo "Image";
                                                                }
                                                                else
                                                                {
                                                                    echo "Gif";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $singleRow['Sticker']['created']; ?>
                                                        </td>
                                                        
                                                        
                                                        <td>
                                                            <div class="more">
                                                                <button id="more-btn" class="more-btn">
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                    <span class="more-dot"></span>
                                                                </button>
                                                                <div class="more-menu">
                                                                    <div class="more-menu-caret">
                                                                        <div class="more-menu-caret-outer"></div>
                                                                        <div class="more-menu-caret-inner"></div>
                                                                    </div>
                                                                    <ul class="more-menu-items" tabindex="-1" role="menu" aria-labelledby="more-btn" aria-hidden="true">
                                                                        <li class="more-menu-item" role="presentation">
                                                                            <a href="process.php?action=deleteSticke&sticker_id=<?php echo $singleRow['Sticker']['id']; ?>">
                                                                                <button type="button" class="more-menu-btn" role="menuitem">Delete</button>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        
                                                        
                                                    </tr>
                                                <?php 
                                                
                                            endforeach; 
                                        }
                                        
                                        
                                    ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th width="180px">Name</th>
                                            <th>Preview</th>
                                            <th>Type</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        
    <script>
        $(document).ready(function () {
            $('#table_view').DataTable({
                    "pageLength": 15
                }
            );
        });
    </script>
    <?php
    
} 
else 
{
	
	echo "<script>window.location='index.php'</script>";
    die;
    
} 

?>