import axios from 'axios'

export default function categories() {
    const categories = [];
    
    axios.get('/api/categories')
            .then(response => {
                categories.value = response.data.categories;
            }) 
  
    return {
        categories
    };
  }