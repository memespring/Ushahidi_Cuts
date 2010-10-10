<?php
/**
 * Main view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com>
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     Admin Dashboard Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General
 * Public License (LGPL)
 */
?>
				<!-- main body -->
				<div id="main" class="clearingfix">
					<div id="mainmiddle" class="floatbox withright">

					<?php if($site_message != '') { ?>
						<div class="green-box">
							<h3><?php echo $site_message; ?></h3>
						</div>
					<?php } ?>

						<!-- right column -->
						<div id="right" class="clearingfix">
					
							<!-- category filters -->
							<div class="cat-filters clearingfix">
								<strong><?php echo Kohana::lang('ui_main.category_filter');?> <span>[<a href="javascript:toggleLayer('category_switch_link', 'category_switch')" id="category_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
							</div>
						
							<ul id="category_switch" class="category-filters">
								<li><a class="active" id="cat_0" href="#"><div class="swatch" style="background-color:#<?php echo $default_map_all;?>"></div><div class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></div></a></li>
								<?php
									foreach ($categories as $category => $category_info)
									{
										$category_title = $category_info[0];
										$category_color = $category_info[1];
										$category_image = '';
										$color_css = 'class="swatch" style="background-color:#'.$category_color.'"';
										if($category_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$category_info[2])) {
											$category_image = html::image(array(
												'src'=>Kohana::config('upload.relative_directory').'/'.$category_info[2],
												'style'=>'float:left;padding-right:5px;'
												));
											$color_css = '';
										}
										echo '<li><a href="#" id="cat_'. $category .'"><div '.$color_css.'>'.$category_image.'</div><div class="category-title">'.$category_title.'</div></a>';
										// Get Children
										echo '<div class="hide" id="child_'. $category .'"><ul>';
										foreach ($category_info[3] as $child => $child_info)
										{
											$child_title = $child_info[0];
											$child_color = $child_info[1];
											$child_image = '';
											$color_css = 'class="swatch" style="background-color:#'.$child_color.'"';
											if($child_info[2] != NULL && file_exists(Kohana::config('upload.relative_directory').'/'.$child_info[2])) {
												$child_image = html::image(array(
													'src'=>Kohana::config('upload.relative_directory').'/'.$child_info[2],
													'style'=>'float:left;padding-right:5px;'
													));
												$color_css = '';
											}
											echo '<li style="padding-left:20px;"><a href="#" id="cat_'. $child .'"><div '.$color_css.'>'.$child_image.'</div><div class="category-title">'.$child_title.'</div></a></li>';
										}
										echo '</ul></div></li>';
									}
								?>
							</ul>
							<!-- / category filters -->
							
							<?php
							if ($layers)
							{
								?>
								<!-- Layers (KML/KMZ) -->
								<div class="cat-filters clearingfix" style="margin-top:20px;">
									<strong><?php echo Kohana::lang('ui_main.layers_filter');?> <span>[<a href="javascript:toggleLayer('kml_switch_link', 'kml_switch')" id="kml_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
								</div>
								<ul id="kml_switch" class="category-filters">
									<?php
									foreach ($layers as $layer => $layer_info)
									{
										$layer_name = $layer_info[0];
										$layer_color = $layer_info[1];
										$layer_url = $layer_info[2];
										$layer_file = $layer_info[3];
										$layer_link = (!$layer_url) ?
											url::base().Kohana::config('upload.relative_directory').'/'.$layer_file :
											$layer_url;
										echo '<li><a href="#" id="layer_'. $layer .'"
										onclick="switchLayer(\''.$layer.'\',\''.$layer_link.'\',\''.$layer_color.'\'); return false;"><div class="swatch" style="background-color:#'.$layer_color.'"></div>
										<div>'.$layer_name.'</div></a></li>';
									}
									?>
								</ul>
								<!-- /Layers -->
								<?php
							}
							?>
							
							
							<?php
							if ($shares)
							{
								?>
								<!-- Layers (Other Ushahidi Layers) -->
								<div class="cat-filters clearingfix" style="margin-top:20px;">
									<strong><?php echo Kohana::lang('ui_main.other_ushahidi_instances');?> <span>[<a href="javascript:toggleLayer('sharing_switch_link', 'sharing_switch')" id="sharing_switch_link"><?php echo Kohana::lang('ui_main.hide'); ?></a>]</span></strong>
								</div>
								<ul id="sharing_switch" class="category-filters">
									<?php
									foreach ($shares as $share => $share_info)
									{
										$sharing_name = $share_info[0];
										$sharing_color = $share_info[1];
										echo '<li><a href="#" id="share_'. $share .'"><div class="swatch" style="background-color:#'.$sharing_color.'"></div>
										<div>'.$sharing_name.'</div></a></li>';
									}
									?>
								</ul>
								<!-- /Layers -->
								<?php
							}
							?>
							
							
							<br />
						
							<!-- additional content -->
							<?php
							if (Kohana::config('settings.allow_reports'))
							{
								?>
								<div class="additional-content">
									<h5><?php echo Kohana::lang('ui_main.how_to_report'); ?></h5>
									<ol>
										<?php if (!empty($phone_array)) 
										{ ?><li><?php echo Kohana::lang('ui_main.report_option_1')." "; ?> <?php foreach ($phone_array as $phone) {
											echo "<strong>". $phone ."</strong>";
											if ($phone != end($phone_array)) {
												echo " or ";
											}
										} ?></li><?php } ?>
										<?php if (!empty($report_email)) 
										{ ?><li><?php echo Kohana::lang('ui_main.report_option_2')." "; ?> <a href="mailto:<?php echo $report_email?>"><?php echo $report_email?></a></li><?php } ?>
										<?php if (!empty($twitter_hashtag_array)) 
													{ ?><li><?php echo Kohana::lang('ui_main.report_option_3')." "; ?> <?php foreach ($twitter_hashtag_array as $twitter_hashtag) {
										echo "<strong>". $twitter_hashtag ."</strong>";
										if ($twitter_hashtag != end($twitter_hashtag_array)) {
											echo " or ";
										}
										} ?></li><?php
										} ?><li><a href="<?php echo url::site() . 'reports/submit/'; ?>"><?php echo Kohana::lang('ui_main.report_option_4'); ?></a></li>
									</ol>
		
								</div>
							<?php } ?>
							<!-- / additional content -->
					
						</div>
						<!-- / right column -->
					
						<!-- content column -->
						<div id="content" class="clearingfix">
							<div class="floatbox">
							
								<!-- filters -->
								<div class="filters clearingfix">
								<div style="float:left; width: 65%">
									<strong><?php echo Kohana::lang('ui_main.filters'); ?></strong>
									<ul>
										<li><a id="media_0" class="active" href="#"><span><?php echo Kohana::lang('ui_main.reports'); ?></span></a></li>
										<li><a id="media_4" href="#"><span><?php echo Kohana::lang('ui_main.news'); ?></span></a></li>
										<li><a id="media_1" href="#"><span><?php echo Kohana::lang('ui_main.pictures'); ?></span></a></li>
										<li><a id="media_2" href="#"><span><?php echo Kohana::lang('ui_main.video'); ?></span></a></li>
										<li><a id="media_0" href="#"><span><?php echo Kohana::lang('ui_main.all'); ?></span></a></li>
									</ul>
</div>
								</div>
								<!-- / filters -->
						
								<!-- map -->
								<div class="map" id="map"></div>
								<div style="clear:both;"></div>
								<div id="mapStatus">
									<div id="mapScale" style="border-right: solid 1px #999"></div>
									<div id="mapMousePosition" style="min-width: 135px;border-right: solid 1px #999;text-align: center"></div>
									<div id="mapProjection" style="border-right: solid 1px #999"></div>
									<div id="mapOutput"></div>
								</div>
								<div style="clear:both;"></div>
								<div class="slider-holder">
									<form action="">
										<input type="hidden" value="0" name="currentCat" id="currentCat">
										<fieldset>
											<div class="play"><a href="#" id="playTimeline">PLAY</a></div>
											<label for="startDate">From:</label>
											<select name="startDate" id="startDate"><?php echo $startDate; ?></select>
											<label for="endDate">To:</label>
											<select name="endDate" id="endDate"><?php echo $endDate; ?></select>
										</fieldset>
									</form>
								</div>
								<!-- / map -->
								<div id="graph" class="graph-holder"></div>
							</div>
						</div>
						<!-- / content column -->
				
					</div>
				</div>
				<!-- / main body -->
			
				<!-- content -->
				<div class="content-container">
			
					<!-- content blocks -->
					<div class="content-blocks clearingfix">
				
						<!-- left content block -->
						<div class="content-block-both">
							<h5><?php echo Kohana::lang('ui_main.incidents_listed'); ?></h5>
						<div class="content-block-left">
							<table class="table-list">
								<thead>
									<tr>
										<th scope="col" class="title"><?php echo Kohana::lang('ui_main.title'); ?></th>
										<th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
										<th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
	 								if ($total_items == 0)
									{
									?>
									<tr><td colspan="3">No Reports In The System</td></tr>

									<?php
									}
									foreach ($incidents as $incident)
									{
										$incident_id = $incident->id;
										$incident_title = text::limit_chars($incident->incident_title, 40, '...', True);
										$incident_date = $incident->incident_date;
										$incident_date = date('M j Y', strtotime($incident->incident_date));
										$incident_location = $incident->location->location_name;
									?>
									<tr>
										<td><a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>"> <?php echo $incident_title ?></a></td>
										<td><?php echo $incident_location ?></td>
										<td><?php echo $incident_date; ?></td>
									</tr>
									<?php
									}
									?>

								</tbody>
							</table>
							<a class="more" href="<?php echo url::site() . 'reports/' ?>">View More...</a>
						</div>
						<!-- / left content block -->
				
						<!-- right content block -->
						<div class="content-block-right">
							<?php
							if ($total_items_col_two < 10)
							{
							?>
							<!-- no incidents for this column -->
							<?php
							} else {
								?>
								<table class="table-list">
									<thead>
										<tr>
											<th scope="col" class="title"><?php echo Kohana::lang('ui_main.title'); ?></th>
											<th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
											<th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
										</tr>
									</thead>
									<tbody>
								<?php foreach ($incidents_col_two as $incident)
								{
									$incident_id = $incident->id;
									$incident_title = text::limit_chars($incident->incident_title, 40, '...', True);
									$incident_date = $incident->incident_date;
									$incident_date = date('M j Y', strtotime($incident->incident_date));
									$incident_location = $incident->location->location_name;
								?>
								<tr>
									<td><a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>"> <?php echo $incident_title ?></a></td>
									<td><?php echo $incident_location ?></td>
									<td><?php echo $incident_date; ?></td>
								</tr>
								<?php
								}
								?>
									</tbody>
								</table>
								<a class="more" href="<?php echo url::site() . 'reports/' ?>">View More...</a>
								<?php 
							}
							?>
									


						</div>
						<!-- / right content block -->
						<div class="content-block-end"></div> 
						</div>
						<!-- / content block both -->
				
					</div>
					<!-- /content blocks -->
<?php
/*
 *					<!-- site footer -->
 *					<div class="site-footer">
 *
 *						<h5>Site Footer</h5>
 *						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Mauris porta. Sed eget nisi. Fusce rhoncus lorem ac erat. Maecenas turpis tellus, volutpat quis, sodales et, consectetuer ac, est. Nullam sed est sed augue vestibulum condimentum. In tellus. Integer luctus odio eu arcu. Pellentesque imperdiet felis eu tortor. Morbi ante dui, iaculis id, vulputate sit amet, venenatis in, turpis. Fusce in risus.
 *
 *					</div>
 *					<!-- / site footer -->
*/
?>
			
				</div>
				<!-- content -->
		
			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->
