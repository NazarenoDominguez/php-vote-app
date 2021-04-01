
<body>
    <div class ="box">
        <canvas id="myChart" ></canvas>
        </div>
</body>
<script>
        var ctx= document.getElementById("myChart").getContext("2d");
        var myChart= new Chart(ctx,{
            type:"bar",
            data:{
                labels:['C','PHP','PYTHON',"JAVA"],
                datasets:[{
                        label:"Popularity percentage",
                        data:[<?php echo $percentToGraph[0]; ?>,<?php echo $percentToGraph[1]; ?>,<?php echo $percentToGraph[2]; ?>,<?php echo $percentToGraph[3]; ?>],
                        backgroundColor:[
                            'rgb(66, 134, 244,0.5)',
                            'rgb(74, 135, 72,0.5)',
                            'rgb(229, 89, 50,0.5)',
                            'rgb(257, 40, 200,0.5)'
                        ]
                }]
            },
            options:{
                scales:{
                    yAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                    }]
                }
            }
        });
</script>

