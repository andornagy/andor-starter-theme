import $ from 'jquery';
import { validateEmail } from '../helpers';

class Newsletter {
   constructor() {
      this.form = $('#newsletter');
      this.notification = this.form.find('.newsletter__notification');
      this.isSending = false;
      this.events();
   }

   events() {
      this.form.submit(e => this.handleSubmit(e));
   }

   // Methods
   handleSubmit(e) {
      e.preventDefault();
      if (this.isSending) return;

      const { status, message } = this.validate();
      if (status === 'error') {
         this.showNotification(message, 'error');
         return;
      }

      $.ajax({
         url: window.themeData.ajax_url,
         data:
            this.form.serialize() +
            '&nonce=' +
            window.themeData.ajax_nonce +
            '&action=process_ajax_newsletter',
         type: 'POST',
         beforeSend: () => {
            this.cleanNotification();
            this.isSending = true;
            this.form.addClass('sending');
         },
         success: async response => {
            try {
               const data = JSON.parse(response);
               console.log(data);

               if (!data.status) this.showNotification(data.message, 'error');
               else {
                  this.showNotification(data.message, 'success');
                  this.form[0].reset();

                  setTimeout(() => this.cleanNotification(), 3000);
               }
            } catch (error) {
               this.showNotification('JSON parse error.', 'error');
            }
         },
         error: () => {
            this.showNotification('Error submitting your email', 'error');
         },
         complete: () => {
            this.isSending = false;
            this.form.removeClass('sending');
         }
      });
   }

   validate() {
      const emailInput = this.form.find('input[name^="input_"]');
      console.log(emailInput);
      const emailVal = emailInput.val();

      if (!emailVal)
         return {
            status: 'error',
            message: 'Please fill in the field'
         };

      if (!validateEmail(emailVal))
         return {
            status: 'error',
            message: 'Please check email format'
         };

      return { status: 'success' };
   }

   showNotification(text, status) {
      this.notification.removeClass('success');
      this.notification.removeClass('error');
      this.notification.addClass(status);
      this.notification.text(text);
   }

   cleanNotification() {
      this.notification.text('');
   }
}

export default new Newsletter();
