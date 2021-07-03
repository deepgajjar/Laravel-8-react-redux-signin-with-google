import Reatc, { useEffect } from 'react';
import { useDispatch } from 'react-redux';
import { SigninForm, accessToken, islogin } from '../actions/actions';
import { useSelector } from 'react-redux';
import axios from 'axios';
import { useHistory } from 'react-router-dom';
import GoogleLogin from 'react-google-login';
const Signin = () =>{
    let hs = useHistory();
    let isloginstatus = useSelector((state)=>{
        return state.IsLogin;
    });
    useEffect(()=>{
        console.log(isloginstatus);
        if(isloginstatus){
            hs.push('/profile');
        }
    });
    let access_token = useSelector((state)=>{
        return state.AccessToken;
    })
    let siteurl = useSelector((state)=>{
        return state.MainUrl;
    });
    let signin_data =  useSelector((state)=>{
        return state.SignInForm;
    });
    let dp = useDispatch();


    const sigInFormClick = (e)=>{
        console.log(siteurl);
        e.preventDefault();
           axios(siteurl+'login/google').then(
               (res)=>{
                   console.log(res);
               }
           ).catch(
               (err)=>{
                   console.log(err);
               }
           );
        }

        // const clickHandler = (e)=>{
        //     e.preventDefault();
        //     var data = window.open("https://accounts.google.com/o/oauth2/auth/oauthchooseaccount?client_id=954006015067-esea86m90t25s5s5gh1508tt757p69n9.apps.googleusercontent.com&redirect_uri=http%3A%2F%2F127.0.0.1%3A8000%2Flogin%2Fgoogle%2Fcallback&scope=openid%20profile%20email&response_type=code&state=XiealPGskVROwPId0zZzZnwpzCXgFUfjmxzaBQzc&flowName=GeneralOAuthFlow","","width=600,height=800");
        //     console.log("clcikc handler window return data",data);
        // }

const responseGoogle = (res)=>{
    console.log("on success google login");
    console.log(res)
    let user_google = {name:res.profileObj.name,email:res.profileObj.email,imageurl:res.profileObj.imageUrl
        ,googleId:res.profileObj.googleId,tokenId:res.tokenId};
        console.log("total response object",user_google);
    axios.post(siteurl+'login/google/callback',user_google).then(
        (res)=>{
            console.log("success web access token",res);
            let token = res.data.success.token;
            dp(accessToken(token));
            window.localStorage.setItem('access_token',token);
            dp(islogin(true));
        }
    ).catch(
        (err)=>{
            console.log(err);
        }
    );
    
}
const FailresponseGoogle = (res)=>{
    console.log(res)
    
}
    return(
        <>
            <div className="container">
            <div className="row justify-content-center">
                <div className="col-sm-5">
                        <div id="signup_mdiv" className="">
                            <p className="text-center" id="form_heading">Sign In Using Google</p>
                            <GoogleLogin
                            clientId="954006015067-rdale70e19pvv1eiiam0vh22dt5mcj2i.apps.googleusercontent.com"
                            buttonText="Sign in with google"
                            onSuccess={responseGoogle}
                            onFailure={FailresponseGoogle}
                            cookiePolicy={'single_host_origin'}
                            />
                            {/* <button onClick={clickHandler}>Login</button> */}

                        
                         </div>
             
                    
                </div>
            </div>
        </div>
        {console.log(signin_data)}
        {console.log("react_store token",access_token)}
        </>
    );
}

export default Signin;