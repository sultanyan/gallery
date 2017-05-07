    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- WYSISWG EDITOR -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Mainscript -->
    <script type="text/javascript" src="js/script.js"></script>

    <!-- DROPZONE -->
    <script type="text/javascript" src="js/dropzone.js"></script>

    <!-- GOOGLE CHARTS CONFIG -->
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Views',     <?php echo $session->count; ?>],
          ['Photos',    <?php echo Photo::count_all(); ?>],
          ['Users',     <?php echo User::count_all(); ?>],
          ['Comments',  <?php echo Comment::count_all(); ?>]
        ]);

        var options = {
          pieSliceText:'label',
          backgroundColor:'transparent'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
</body>
</html>
