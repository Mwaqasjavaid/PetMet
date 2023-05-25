
<template>
  <div class="max-w-[1100px] pt-[56px] mx-auto pb-1 mt-0">
    <img class="rounded-b-xl ml-[469px]" src="/images/icons/Petmetlogo.jpg">
  </div>

  
  <div class="h-[100vh] flex flex-col items-center pt-[11px] bg-blue-100 pb-[120px]">
    <div v-if="successMessage" class="success-message">
      {{ successMessage }}
    </div>
    <!-- <button @click="toggleForm">ADD PETS</button> -->
    <!-- Conditionally render the form based on the 'showForm' data property -->
    <form @submit.prevent="submitForm">
      <!-- Form fields and inputs -->
      <div class="">
        <div class="">
          <label class="">
            Pet Name
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="pet-name" v-model="formData.name" type="text" placeholder="Tom">
          
           </div>
      </div>
      <div class="">
        <div class="">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pet-category">
            Category
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="pet-category" v-model="formData.category" type="text" placeholder="Cat">
        </div>
      </div>
      
        <div class="">
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="pet-age">
            Age
          </label>
          <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="pet-age" v-model="formData.age" type="text" placeholder="4 years">
        </div>
      
      <!-- Other form fields -->
      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
        Save
      </button>
    </form>
  </div>
</template>

<script>
import UserNavLayout from "@/Layouts/UserNavLayout.vue";
import { ref } from 'vue';
import { post, Inertia } from '@inertiajs/inertia';
import { Link, router, usePage} from '@inertiajs/vue3';


export default {
  setup() {
    const formData = ref({
      name: '',
      category: '',
      age: '',
    });

    const successMessage = ref('');

    const toggleForm = () => {
      showForm.value = !showForm.value;
    };

    const submitForm = async () => {
      const requestData = {
        name: formData.value.name,
        category: formData.value.category,
        age: formData.value.age,
      };

      // await router.post(route('AddPets'), requestData)
      //   .then(response => {
      //     // Handle the response
      //     console.log(response.data.message);

      //     // Store the success message in the ref
      //     successMessage.value = response.data.message;
      //   })
      //   .catch(error => {
      //     // Handle the error, e.g., show error message, validation errors, etc.
      //     console.error(error);
      //   });


      // Use the post function from @inertiajs/inertia
      // console.log(" testing data",requestData)
      // router.post('/pets', requestData)
      //   .then(response => {
      //     // Handle the response, e.g., show success message, redirect, etc.
      //     console.log(response.data.message);
      //   })
      //   .catch(error => {
      //     // Handle the error, e.g., show error message, validation errors, etc.
      //     console.error(error);
      //   });
        
        try {
          var response = await router.post('/pets', requestData);
          console.log(response);
        }
        catch(error) {
          console.error(error);

        }
    };

    const showForm = ref(false);

    return {
      formData,
      toggleForm,
      submitForm,
      showForm,
      successMessage,
    };
  },
};
</script>
