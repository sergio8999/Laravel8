import axios from 'axios'

export function getCategories() {
 
  return axios.get('/api/categories');
            
}

export function getCategory(id){
    return axios.get('/api/categories/'+ id);
}

export function getHouses(){
    return axios.get('/api/houses');
}

export function getHouse(id){
    return axios.get('/api/house/'+ id);
}

export function getLocations(){
    return axios.get('/api/locations');
}

export function getReservationsHouse(id){
    return axios.post('/api/reservation/allReservationHouse',{'house_id' : id});
}

export function getReservationUser(id){
    return axios.post('/api/reservation/show',{'user_id': id});
}

export function setReservationHouse(arrivalDay, departureDay, taxes, arrivalTime, departureTime, subtotal, total, user_id, house_id){
    return axios.post('/api/reservation',{
        'arrivalDay' : arrivalDay,
        'departureDay' : departureDay,
        'taxes' : taxes,
        'arrivalTime' : arrivalTime,
        'departureTime' : departureTime,
        'subtotal' : subtotal,
        'total' : total,
        'user_id' : user_id,
        'house_id' : house_id
    })
}