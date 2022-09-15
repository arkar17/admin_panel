$(document).ready(function(){

    $(".daily-sale-book-category").click(function(){
        // console.log("clicked")
        $(".daily-sale-book-categories-active").removeClass("daily-sale-book-categories-active")
        $(this).addClass("daily-sale-book-categories-active")

        if($("#2d_sale_list").hasClass("daily-sale-book-categories-active")){

            $(".daily-sale-book-2d-parent-container").addClass("appear")
            $(".daily-sale-book-3d-parent-container").removeClass("appear")
            $(".daily-sale-book-lonepyine-parent-container").removeClass("appear")
        }
        // })
        if($("#3d_sale_list").hasClass("daily-sale-book-categories-active")){

            $(".daily-sale-book-3d-parent-container").addClass("appear")
            $(".daily-sale-book-2d-parent-container").removeClass("appear")
            $(".daily-sale-book-lonepyine-parent-container").removeClass("appear")
        }
        if($("#lonepyine_sale_list").hasClass("daily-sale-book-categories-active")){

            $(".daily-sale-book-lonepyine-parent-container").addClass("appear")
            $(".daily-sale-book-3d-parent-container").removeClass("appear")
            $(".daily-sale-book-2d-parent-container").removeClass("appear")
        }
    })

    if($("#2d_sale_list").hasClass("daily-sale-book-categories-active")){
        $(".daily-sale-book-2d-parent-container").addClass("appear")
        $(".daily-sale-book-3d-parent-container").removeClass("appear")
        $(".daily-sale-book-lonepyine-parent-container").removeClass("appear")
    }
    // })
    if($("#3d_sale_list").hasClass("daily-sale-book-categories-active")){
        $(".daily-sale-book-3d-parent-container").addClass("appear")
        $(".daily-sale-book-2d-parent-container").removeClass("appear")
        $(".daily-sale-book-lonepyine-parent-container").removeClass("appear")
    }
    if($("#lonepyine_sale_list").hasClass("daily-sale-book-categories-active")){
        $(".daily-sale-book-lonepyine-parent-container").addClass("appear")
        $(".daily-sale-book-3d-parent-container").removeClass("appear")
        $(".daily-sale-book-2d-parent-container").removeClass("appear")
    }

    //2d number details(compenstion,max, sale)
    // $(".daily-sale-book-2dlist-row").each(function(index){
    //     for(let i = 0; i <= 8; i++){
    //         $(this).append(`
    //         <div class="daily-sale-book-2dlist-item-container">
    //             <p>${i}</p>
    //             <div class="daily-sale-book-2dlist-item-rate">
    //                 <p>Rate:</p>
    //                 <p>85</p>

    //             </div>
    //             <div class="daily-sale-book-2dlist-item-max">
    //                 <p>Max:</p>
    //                 <p>100000</p>
    //             </div>
    //             <div class="daily-sale-book-2dlist-item-sale">
    //                 <p>Sale:</p>
    //                 <p>50%</p>
    //             </div>
    //         </div>`)
    //     }
    // })

    let dataArr = []


    $.getJSON('http://165.22.51.1/twodlist', (data, jqXHR) => {
        //2d 1st row
        // console.log(data.data.salesList);
    for(let i = 0;i <= 8;i++){
        // console.log(dataArr[i])
        $('.daily-sale-book-2dlist-1row').append(`
            <div class="daily-sale-book-2dlist-item-container">
                <p>${data.data.salesList[i].number}</p>
                <div class="daily-sale-book-2dlist-item-rate">
                    <p>Rate:</p>
                    <p>${data.data.salesList[i].compensation}</p>

                </div>
                <div class="daily-sale-book-2dlist-item-max">
                    <p>Max:</p>
                    <p>${data.data.salesList[i].max_amount}</p>
                </div>
                <div class="daily-sale-book-2dlist-item-sale">
                    <p>Sale:</p>
                    <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                </div>
            </div>`)
    }
                //2d2nd row
            for(let i = 9 ; i <= 17;i++){
                $('.daily-sale-book-2dlist-2row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 3rd row
            for(let i = 18;i <= 26;i++){
                $('.daily-sale-book-2dlist-3row').append(`
                <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 4th row
            for(let i = 27;i <= 35;i++){
                $('.daily-sale-book-2dlist-4row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 5th row
            for(let i = 36;i <= 44;i++){
                $('.daily-sale-book-2dlist-5row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 6th row
            for(let i = 45;i <= 53;i++){
                $('.daily-sale-book-2dlist-6row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 7th row
            for(let i = 54;i <= 62;i++){
                $('.daily-sale-book-2dlist-7row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                    <p>${data.data.salesList[i].number}</p>
                    <div class="daily-sale-book-2dlist-item-rate">
                        <p>Rate:</p>
                        <p>${data.data.salesList[i].compensation}</p>

                    </div>
                    <div class="daily-sale-book-2dlist-item-max">
                        <p>Max:</p>
                        <p>${data.data.salesList[i].max_amount}</p>
                    </div>
                    <div class="daily-sale-book-2dlist-item-sale">
                        <p>Sale:</p>
                        <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                    </div>
                    </div>`)
            }

            //2d 8th row
            for(let i = 63;i <= 71;i++){
                $('.daily-sale-book-2dlist-8row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 9th row
            for(let i = 72;i <= 80;i++){
                $('.daily-sale-book-2dlist-9row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                    <p>${data.data.salesList[i].number}</p>
                    <div class="daily-sale-book-2dlist-item-rate">
                        <p>Rate:</p>
                        <p>${data.data.salesList[i].compensation}</p>

                    </div>
                    <div class="daily-sale-book-2dlist-item-max">
                        <p>Max:</p>
                        <p>${data.data.salesList[i].max_amount}</p>
                    </div>
                    <div class="daily-sale-book-2dlist-item-sale">
                        <p>Sale:</p>
                        <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                    </div>
                    </div>`)
            }

            //2d 10th row
            for(let i = 81;i <= 89;i++){
                $('.daily-sale-book-2dlist-10row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                        <p>${data.data.salesList[i].number}</p>
                        <div class="daily-sale-book-2dlist-item-rate">
                            <p>Rate:</p>
                            <p>${data.data.salesList[i].compensation}</p>

                        </div>
                        <div class="daily-sale-book-2dlist-item-max">
                            <p>Max:</p>
                            <p>${data.data.salesList[i].max_amount}</p>
                        </div>
                        <div class="daily-sale-book-2dlist-item-sale">
                            <p>Sale:</p>
                            <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                        </div>
                    </div>`)
            }

            //2d 11st row
            for(let i = 90;i <= 98;i++){
                $('.daily-sale-book-2dlist-11row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                    <p>${data.data.salesList[i].number}</p>
                    <div class="daily-sale-book-2dlist-item-rate">
                        <p>Rate:</p>
                        <p>${data.data.salesList[i].compensation}</p>

                    </div>
                    <div class="daily-sale-book-2dlist-item-max">
                        <p>Max:</p>
                        <p>${data.data.salesList[i].max_amount}</p>
                    </div>
                    <div class="daily-sale-book-2dlist-item-sale">
                        <p>Sale:</p>
                        <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                    </div>
                    </div>`)
            }

            //2d 12st row
            for(let i = 99;i <= 99;i++){
                $('.daily-sale-book-2dlist-12row').append(`
                    <div class="daily-sale-book-2dlist-item-container">
                    <p>${data.data.salesList[i].number}</p>
                    <div class="daily-sale-book-2dlist-item-rate">
                        <p>Rate:</p>
                        <p>${data.data.salesList[i].compensation}</p>

                    </div>
                    <div class="daily-sale-book-2dlist-item-max">
                        <p>Max:</p>
                        <p>${data.data.salesList[i].max_amount}</p>
                    </div>
                    <div class="daily-sale-book-2dlist-item-sale">
                        <p>Sale:</p>
                        <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                    </div>
                    </div>`)
            }

    });





    $.getJSON('http://165.22.51.1/lonepyinelist', (data, jqXHR) => {
    console.log(data.data.salesList)
    //lonepyine 1st row
    for(let i = 0; i<= 8;i++){
        $('.daily-sale-book-lonepyinelist-1row').append(`
            <div class="daily-sale-book-lonepyinelist-item-container">
                <p>${i}∞</p>
                <div class="daily-sale-book-lonepyinelist-item-rate">
                    <p>Rate:</p>
                    <p>${data.data.salesList[i].compensation}</p>

                </div>
                <div class="daily-sale-book-lonepyinelist-item-max">
                    <p>Max:</p>
                    <p>${data.data.salesList[i].max_amount}</p>
                </div>
                <div class="daily-sale-book-lonepyinelist-item-sale">
                    <p>Sale:</p>
                    <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                </div>
            </div>`)
    }

    //lone pyine 2nd row
    for(let i = 9; i<= 17;i++){
        $('.daily-sale-book-lonepyinelist-2row').append(`
            <div class="daily-sale-book-lonepyinelist-item-container">
                <p>${i > 9 ? `∞${i.toString().split("")[1]}`: `${i}∞`}</p>
                <div class="daily-sale-book-lonepyinelist-item-rate">
                <p>Rate:</p>
                <p>${data.data.salesList[i].compensation}</p>

            </div>
            <div class="daily-sale-book-lonepyinelist-item-max">
                <p>Max:</p>
                <p>${data.data.salesList[i].max_amount}</p>
            </div>
            <div class="daily-sale-book-lonepyinelist-item-sale">
                <p>Sale:</p>
                <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
            </div>
            </div>`)
    }

    //lone pyine 3rd row
    for(let i = 18; i<= 19;i++){
        $('.daily-sale-book-lonepyinelist-3row').append(`
            <div class="daily-sale-book-lonepyinelist-item-container">
                <p>${i > 9 ? `∞${i.toString().split("")[1]}`: `${i}∞`}</p>
                <div class="daily-sale-book-lonepyinelist-item-rate">
                    <p>Rate:</p>
                    <p>${data.data.salesList[i].compensation}</p>

                </div>
                <div class="daily-sale-book-lonepyinelist-item-max">
                    <p>Max:</p>
                    <p>${data.data.salesList[i].max_amount}</p>
                </div>
                <div class="daily-sale-book-lonepyinelist-item-sale">
                    <p>Sale:</p>
                    <p>${data.data.salesList[i].sales == null? `0` : data.data.salesList[i].sales}</p>
                </div>
            </div>`)
    }
});
    //charts
    const labels = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
      ];

      const data = {
        labels: labels,
        datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: [0, 10, 5, 2, 20, 30, 45],
        }]
      };

      const config = {
        type: 'line',
        data: data,
        options: {}
      };

      const twodChart = new Chart(
        document.getElementById('daily-sale-book-2d-chart'),
        config
      );
      const lonepyineChart = new Chart(
        document.getElementById('daily-sale-book-lonepyine-chart'),
        config
      );
      const threedChart = new Chart(
        document.getElementById('daily-sale-book-3d-chart'),
        config
      );


      //accept decline list
      for(let i = 1;i <= 3;i++){
        $(".daily-sale-book-rows-container").append(
            `<div class="daily-sale-book-row">
            <p>${i}</p>
            <p>24 Aug</p>
            <p>Agent 01</p>
            <p>Morning</p>
            <p>Lone Pyine</p>
            <div class="daily-sale-book-row-numbers">
              <p>74</p>
              <p>56</p>
              <p>89</p>
            </div>
            <div class="daily-sale-book-row-compensations">
              <p>74</p>
              <p>56</p>
              <p>89</p>
            </div>
            <div class="daily-sale-book-row-amounts">
              <p>1000ks</p>
              <p>400ks</p>
              <p>3000ks</p>
            </div>
            <div class="daily-sale-book-row-btn-container">
                <button class="daily-sale-book-accept-btn">Accept</button>
                <button class="daily-sale-book-decline-btn">Decline</button>
            </div>
        </div>`
        )
      }


      //2d lone pyine sale record list
    //   for(let i = 1; i<= 3;i++){
    //     $(".daily-sale-book-sale-record-rows-container").append(`
    //     <div class="daily-sale-book-sale-record-row">
    //                         <p>${i}</p>
    //                         <p>24 Aug</p>
    //                         <p>Agent 01</p>
    //                         <p>Morning</p>
    //                         <p>Lone Pyine</p>
    //                         <div class="daily-sale-book-sale-row-numbers">
    //                           <p>74</p>
    //                           <p>56</p>
    //                           <p>89</p>
    //                         </div>
    //                         <div class="daily-sale-book-sale-row-compensations">
    //                           <p>74</p>
    //                           <p>56</p>
    //                           <p>89</p>
    //                         </div>
    //                         <div class="daily-sale-book-sale-row-amounts">
    //                           <p>1000ks</p>
    //                           <p>400ks</p>
    //                           <p>3000ks</p>
    //                         </div>
    //                         <p>Accepted</p>
    //                       </div>`)
    //   }



})
