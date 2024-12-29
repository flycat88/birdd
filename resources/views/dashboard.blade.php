<x-app-layout>
   
<div>
         



        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="container"
        style="width:250px"
        >
            <h2></h2>
            <canvas id="occupancyChart" ></canvas>
        </div>




   

        <script>
            var occupancyData = @json($occupancyData);
            var occupied = occupancyData.occupied;
            var vacant = occupancyData.vacant;

            var ctx = document.getElementById('occupancyChart').getContext('2d');
            var occupancyChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Occupied', 'Vacant'],
                    datasets: [{
                        label: 'Occupancy Status',
                        data: [occupied, vacant],
                        backgroundColor: ['#738a6e', '#bfcfbb'],
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                    }
                }
            });
        </script>
  
</x-app-layout>
