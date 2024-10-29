//get the question value
window.addEventListener("load", async function () {
    let account_created = document.querySelector(
      "input[name='aionchat_options[account_created]']"
    );
    handleChange(account_created.value);
    if (account_created.value === ""){
      document.getElementById('guest-form-container').style.visibility= "hidden";
      document.getElementById('infos-chatbot').style.visibility= "hidden";
      //account_created.value = "";
      // console.log(account_created.value);
    }
  });
  
  //show the valid area, depending on the answer
  const handleChange = (value) => {
    let user_form_container = document.querySelector("#user-form-container");
  
    let user_form_table = document.querySelector("#user-form-table");
  
    let guest_form_container = document.querySelector("#guest-form-container");
  
    let account_created = document.querySelector(
      "input[name='aionchat_options[account_created]']"
    );


  
    if (value === "1") {
        document.getElementById('infos-chatbot').style.visibility= "visible";
        document.getElementById('guest-form-container').style.visibility= "hidden";
        account_created.value = "1";
    }
    if (value === "0") {
       account_created.value = "0";
    //   user_form_container.classList.add("user-form");
    //   user_form_table.classList.add("user-form");
    //   guest_form_container.classList.remove("guest-form");
      document.getElementById('infos-chatbot').style.visibility= "hidden";
      document.getElementById('guest-form-container').style.visibility= "visible";
    
    }
  };