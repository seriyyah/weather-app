<template>
<div :class="isDay ? 'day' : 'night'">
  <div class="text-white mb-8">
    <!-- input search -->
    <div class="places-input.text-gray-800">
      <input type="text" class="w-full">
    </div>
    <!-- end input search -->
    <!-- main weather container -->
    <div class="weather-container rounded-lg font-sans w-128 max-w-lg overflow-hidden bg-gray-900 shadow-lg mt-4">
    <!-- current weather -->
    <div class="current-weather flex items-center justify-between px-6 py-8">
      <div class="flex items-center">
        <div>
          <div class="text-6xl font-semibold">{{currentTemperature.actual}}°C</div>
          <div>Feels like {{currentTemperature.feels}}°C</div>
        </div>
        <div class="mx-5">
          <div class="font-semibold">{{currentTemperature.summary}}</div>
          <div>{{location.name}}</div>
        </div>
      </div>
      <div v-for="item in imgs" :key="item.id"><img v-bind:src="'http://openweathermap.org/img/wn/' + item + '.png'"></div>
    </div>
    <!-- end current weather -->
    <!-- other weather days -->
    <div class="future-weather text-sm bg-gray-800 px-6 py-8 overflow-hidden">
      <div v-for="(day, index) in dailyTemperature" :key="index" :class="{'mt-8':index>0}">
      <DailyForecast :day="day"/>

      </div>
    </div>
    <!-- end other weather days -->
    </div>
<!-- end main weather container -->
  </div>
  </div>
</template>

<script>
    import DailyForecast from './DailyForecast'
    export default {
        mounted() {
            this.fetchData()
        },
  components:{
    DailyForecast,
  },

        data(){
          return{
            isDay:true,
            imgs:[],
            currentTemperature:{

              feels:'',
              actual:'',
              summary:'',
              icon:'',

            },

            dailyTemperature:[],
            location: {
              name: 'Kharkov',
              lat:49.9935,
              lng:36.2304,

            }


          }
        },

        methods: {
          fetchData() {
            fetch(`/api/weather?lat=${this.location.lat}&lon=${this.location.lng}`)
            .then(response => response.json())
            .then(data => {
              console.log(data)
              this.currentTemperature.actual = Math.round(data.current.temp)
              this.currentTemperature.feels = Math.round(data.current.feels_like)
              this.currentTemperature.summary = data.current.weather[0].description
              this.currentTemperature.icon = data.current.weather[0].icon
              // img for cur
              this.imgs.push(data.current.weather[0].icon);
              


              this.dailyTemperature = data.daily.slice(1,6)
              console.log(this.dailyTemperature);




                const timeOfDay = data.current.weather[0].icon;

                if(timeOfDay.includes("n")){
                  this.isDay = false;
                }else{
                  this.isDay = true;
                }

            })

          }
        },


    }
</script>
