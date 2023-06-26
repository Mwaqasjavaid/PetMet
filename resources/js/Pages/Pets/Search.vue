<script setup
> 
import Magnify from "vue-material-design-icons/Magnify.vue";
import { Inertia } from "@inertiajs/inertia";
import { router, usePage } from "@inertiajs/vue3";


var pets=[
];
var search='';
function fetchSearchResults(){
    console.log('tewn',search);
    if (search.length == 0) {
      pets = [];
    }

    // axios.get('/pets/search', { params: { search: search } })
    //     .then(response => {
    //       pets = response.data.pets;
    //       console.log(response.data.pets);
    //       console.log(pets);
    //     })
    //     .catch(error => {
    //       console.error(error);
    //     });


    watch(search, (value) => {
      axios.get('/pets/search', { params: { search: search } })
        .then(response => {
          pets = response.data.pets;
          console.log(response.data.pets);
          console.log(pets);
        })
        .catch(error => {
          console.error(error);
        });
    });


}

// setup(props) {
//     const searchTerm = ref(props.keyword);

//     watch(searchTerm, (newTerm) => {
//      axios.get('/pets/search', { params: { keyword: newTerm } })
//         .then(response => {
//           props.pets = response.data.pets;
//         })
//         .catch(error => {
//           console.error(error);
//         });
//     });

//     return {
//       searchTerm,
//     };
// };
</script>
<template>
<div
class="flex items-center justify-center bg-transparent border-2 p-1 rounded-full h-[40px] w-[300px] ml-[6.5rem]"
>
<Magnify class="p-1" :size="22" fillColor="white" />

<div>
  <input
    v-model="search"
    class="bg-transparent lg:block hidden border-none p-0 text-white placeholder-white ring-0 focus:ring-0"
    placeholder="Search here"
    type="text"
    @input="fetchSearchResults"
/>
  
  <div style="position: relative;width: 100%;">
    <ul style="position: absolute;background: #fff;width: 100%;height: auto;z-index: 10;" v-if="pets.length > 0" class="mt-4">
      <li v-for="pet in pets" :key="pet.id" class="text-black p-3">
          {{ pet.name }}
      </li>
    </ul>
    <p v-else-if="search && pets.length === 0" class="mt-4 text-white">
    No pets found for "{{ search }}"
    </p> 
  </div>
</div>


</div>
  <!-- <ul>
    <li v-for="pet in pets" :key="pet.id">
        {{ pet.name }}
    </li>
  </ul> -->
   
</template>
<script>
import { ref, watch } from 'vue';

export default {
  props: {
    keyword: {
      type: String,
      required: true,
    },
    pets: {
      type: Array,
      required: true,
    },
  },
  setup(props) {
    const searchTerm = ref(props.keyword);

    // watch(searchTerm, (newTerm) => {
    //  axios.get('/pets/search', { params: { keyword: newTerm } })
    //     .then(response => {
    //       props.pets = response.data.pets;  
    //     })
    //     .catch(error => {
    //       console.error(error);
    //     });
    // });

    watch(search, (value) => {
      Inertia.get(
          "/",
          { search: value },
          {
              preserveState: true,
              replace: true,
          }
      );
    });

    return {
      search,
    };
  },
};
</script>

    <!--  old is working here just changing here new  -->

   


