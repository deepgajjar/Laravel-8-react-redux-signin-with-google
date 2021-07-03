import React, { useEffect } from 'react';
import ReactDOM from 'react-dom';
import { Route, Switch, useHistory } from 'react-router-dom';
import Header from './Header';
import '../../css/app.css';
import Signin from './Signin';
import { useSelector, useDispatch } from 'react-redux';
import { accessToken, islogin } from '../actions/actions';
import Profile from './Profile';
function Root() {
    let hs = useHistory();
    let isloginstatus = useSelector((state)=>{
        return state.IsLogin;
    });
    let dp = useDispatch();
    let siteurl = useSelector((state)=>{
        return state.MainUrl;
    });
    useEffect(()=>{
        if("access_token" in window.localStorage){
            let token = window.localStorage.getItem("access_token");
            axios.get(siteurl+"check_token",{headers:{"Authorization":`Bearer ${token}`}}).then(
                (res)=>{
                    console.log(res);
                    if(res.status == 200){
                        dp(accessToken(token));
                        dp(islogin(true));
                    }
            }).catch((err)=>{   
                console.log(err);
                if(err.response.status == 401){
                    window.localStorage.removeItem("access_token");
                    dp(islogin(false));
                }
            });
        }
    });


// end all code 


    return (
        <>
            <Header />
            <Switch>
                <Route exact path='/profile' component={Profile} />
                <Route exact path="/" component={Signin} />
            </Switch>
        </>
    );
}

export default Root;


