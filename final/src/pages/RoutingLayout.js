import { Link, Outlet } from "react-router-dom";

function RoutingLayout(props){
  const loggedUser = props.loggedUser;
  return (
  <>
    <header class="navFooter-header">
        <div class="logo">
          <h1>WHS<i class="fa-solid fa-house"></i></h1>
          <p>Wood Housing Solution</p>
      </div>
      <nav>
        <ul>
          <li>
            <Link to="/">Yourpost</Link>
          </li>
          <li>
            <Link to="/findpost">Find Share house</Link>
          </li>
          <li>
            <Link to="/profile">Your profile</Link>
          </li>
          <li>
          { loggedUser ==="" ? <Link to="/login">Login</Link> : <Link to="/logout">Logout</Link>}
          </li>
        </ul>
      </nav>
      <div class="setting-wrap">
        <ul class="setting">
          <li class="setting-icon">
            <i class="fa-solid fa-gear"></i>
            <ul class="subMenu">
              <li>
                <Link to ="/">Dash Board</Link>
              </li>
              <li>
                <Link to ="/logout">Log out</Link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </header>
      <Outlet/>

    <footer>&copy; Wood housing solution</footer>
  </>
  )
}

export default RoutingLayout;