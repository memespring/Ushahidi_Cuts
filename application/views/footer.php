<?php 
/**
 * Footer view page.
 *
 * PHP version 5
 * LICENSE: This source file is subject to LGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/lesser.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.ushahididev.com
 * @module     API Controller
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License (LGPL) 
 */
?>
     
 
	<!-- footer -->
	<div id="footer" class="clearingfix">
 
		<div id="underfooter"></div>
 
		<!-- footer content -->
		<div class="rapidxwpr floatholder">
 
			<!-- / footer credits -->
		
			<!-- footer menu -->
			<div class="footermenu">
				<ul class="clearingfix">
					<li><a class="item1" href="<?php echo url::site(); ?>"><?php echo Kohana::lang('ui_main.home'); ?></a></li>
					<li><a href="<?php echo url::site()."reports/submit"; ?>"><?php echo Kohana::lang('ui_main.report_an_incident'); ?></a></li>
				</ul>
				
			</div>
			<div class="footermenu project-credits">
			    <a href="http://okfn.org/" title="Open Knowledge Foundation">Open Knowledge Foundation</a>
				    <img src="<?php echo url::base(); ?>/media/img/okfn.png"/>
				</a>
				<p id="aboutokfn">
				An <a href="http://okfn.org/" title="Open Knowledge Foundation">Open Knowledge Foundation</a> project.
				<br/>
				The Open Knowledge Foundation is a<br/> not-for-profit organization promoting open knowledge.
				</p>
				<p id="poweredby">
				Powered by <a href="http://www.ushahidi.com/"><img src="<?php echo url::base(); ?>/media/img/footer-logo.png" alt="Ushahidi" align="absmiddle" /></a>
				</p>
			</div>
		
			
			<!-- / footer menu -->

 
		</div>
		<!-- / footer content -->
 
	</div>
	<!-- / footer -->
 
	<?php echo $ushahidi_stats; ?>
	<?php echo $google_analytics; ?>
	
	<!-- Task Scheduler -->
	<img src="<?php echo url::site().'scheduler'; ?>" height="1" width="1" border="0" />
 
</body>
</html>