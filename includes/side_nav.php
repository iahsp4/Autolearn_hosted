<ul class="nav nav-pills nav-stacked pills">
                <li><a href="home.php"><img src="./Images/home-icon.png" height="20px"  width="20px" style="margin-right:10px"> Home</a></li>
                <li><a href="student_details.php" ><img src="./Images/report-3-xxl.png" height="20px"  width="20px" style="margin-right:10px">Student Data</a></li>
                <li><a href="student_reg.php"><img src="./Images/ocha_activity-reporting_simple-black_512x512.png" height="20px"  width="20px" style="margin-right:10px">Student Registration</a></li>
                <li><a href="reports.php"><img src="./Images/bw-data-template.png" height="20px"  width="20px" style="margin-right:10px">Reports</a></li>
</ul>

<script>
	$(document).ready(function(e) {
		var name = location.pathname.split('/')[1];
		$("li:has(a[href='"+name+"'])").addClass("active");
    });
</script>