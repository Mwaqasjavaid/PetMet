
<template>
<div
class="flex relative items-center justify-center bg-transparent border-2 p-1 rounded-full h-[40px] w-[300px] ml-[6.5rem]"
>
<!-- <Magnify @click="fetchSearchResults()" class="p-1" :size="22" fillColor="white" /> -->
<button @click="getPets">Search</button>
<div  class="flex ml-2">
  <input
    v-model="search"
    class="bg-transparent lg:block hidden border-none p-0 text-white placeholder-white ring-0 focus:ring-0"
    placeholder="" 
    type="text"
/>
<!-- <button @click="fetchSearchResults()">search</button> -->
  
  <div style="position: absolute;bottom: 0;left: 0;width: 100%; ">
    <ul v-if="pets" style="position: absolute;background: #fff;height: 70px;z-index: 10; overflow-y: scroll; width: 300px; top: 3px; border-radius: 20px;"  class="mt-4">
      <li v-for="pet in pets" :key="pet.id" class="text-black p-3">
          
            <a :href="`/pet/${pet.id}`" class="flex items-center justify-start w-full cursor-pointer hover:bg-[#E5E6E9] p-2 rounded-md">
                        <img class="rounded-full ml-1 min-w-[38px] max-h-[38px]" :src="pet.image">
                        <div class="text-[15px] text-gray-800 font-extrabold pl-3">{{ pet.name }}</div>
            </a>
      
      </li>
    </ul>
    <ul v-else style="position: absolute;background: #fff;height: auto;z-index: 10;"  class="mt-4">
      <li class="text-black p-3">
          No pets found
      </li>
    </ul>
  </div>
</div>
</div>
 
   
</template>
<script>
import Magnify from 'vue-material-design-icons/Magnify.vue'
import { ref, onMounted } from 'vue';

export default {
  setup() {
    const search = ref('');
    const isLoading = ref(false);
    const pets = ref([]);

    const getPets = async () => {
      isLoading.value = true;

    axios.get('/pets/search', { params: { search: search.value } })
    .then(response => {
      pets.value = response.data.pets;
      console.log('response', response.data.pets);
      console.log(pets.value);
    })
    .catch(error => {
      console.error(error);
    });
    };

    onMounted(getPets);

    return {
      search,
      pets,
      isLoading,
      getPets,
    };
  },
};
</script>






    <!--  old is working here just changing here new  -->

   


