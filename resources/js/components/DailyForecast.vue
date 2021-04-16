<template>
<div class="flex items-center">


  <div class="w-1/6 text-lg text-gray-200">{{new Date(this.day.dt * 1000).toLocaleString("en-us", {weekday: "long"})}}</div>
   <div class="w-4/6 px-4 flex items-center">
      <div><img :src="`http://openweathermap.org/img/wn/${this.day.weather[0].icon}.png`"></div>
      <div class="ml-3">{{this.day.weather[0].description}}</div>
  </div>
  <div class="w-1/6 text-right">
  <div>{{Math.round(this.day.temp.max)}}°C</div>
  <div>{{Math.round(this.day.temp.min)}}°C</div>
  </div>
</div>

</template>

<script>


export default {
  name:"DailyForecast",
  props:["day"],
  //  props:["item"],
 

}

</script>
