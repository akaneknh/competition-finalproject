import { BrowserRouter, Routes, Route} from "react-router-dom";
import RoutingLayout from "./pages/RoutingLayout";
import Yourpost from "./pages/Yourpost";
import Showpost from "./pages/Showpost";
import Findpost from "./pages/Findpost";
import Login from "./pages/Login";
import Nopage from "./pages/Nopage";
import Register from "./pages/Register";
import Logout from "./pages/Logout";
import Profile from "./pages/Profile"
import { useEffect, useState } from 'react';
import $, { data } from 'jquery';

export function MainApp(){
  const[user,setUser] = useState('');
  const loginFunction =(userInput)=> {
    setUser(userInput);
  }

  const pageload = () =>{
    let sid = sessionStorage.getItem("sid");
    if(sid != null){
      $.ajax({
        type: "POST",
        url: "http://localhost/react/sidChk.php",
        data: {sid:sid},
        success(data){
          console.log(data);
        }
      })
    }
  }
  useEffect(()=>pageload(),[user]);
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<RoutingLayout loggedUser={user}/>}>
        {/* homepage replacement*/}
          <Route index element = {<Yourpost loggedUser={user}/>}/>
          <Route path="login" element = { <Login loginFun={loginFunction}/>}/>
          <Route path="logout" element = {<Logout loggedUser={user} loginFun={loginFunction}/>}/>
          <Route path="profile" element = { <Profile loginFun={loginFunction}/>}/>
          <Route path="register" element = {<Register loggedUser={user}/>}/>
          <Route path="showpost" element = {<Showpost loggedUser={user}/>}/>
          <Route path="findpost" element = {<Findpost loggedUser={user}/>}/>
          <Route path="*" element = { <Nopage/>}/>
        </Route>
      </Routes>
    </BrowserRouter>
  )
}
