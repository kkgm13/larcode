<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <ul v-for="meet in meetingList" :meet="meet" :key="meet.id">
                    <li>{{ meet.title }}</li>
                    <meet-item :schedule="meet.schedule"></meet-item>                
                </ul>
            </div>
        </div>
    </div>
</template> 
<script>
// Import the Single Meeting Component
import meetItem from "./MeetingComponent"
// Export the Vue Component
export default {
    // Component Mounted to the Application
    mounted() {
        console.log('Meeting List Component mounted.')
    },
    // External VUE files that are used.  
    components: {
        meetItem
    },
    // Data to call/grab initial data
    data: function() {
        return {
            meetingList : [],
        }
    },
    // Initial actions when Vue Component Created 
    created() {
       this.fetchMeetingList()
    },
    // Methods used in this Vue Component
    methods: {
        /**
         * Fetch the meetings available via Axios route caller.
         * @todo Find a way to auto sync when list updates
         */
        fetchMeetingList: function(){
            axios.get('/meetings')
            .then((result) => {
                this.meetingList = result.data
            })
            .catch(err => {
                console.log(err)
            })
        }
    },
}
</script>