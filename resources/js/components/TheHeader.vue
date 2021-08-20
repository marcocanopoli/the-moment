<template>
    <header class="header">
        <nav class="navbar">
            <img class="logo" src="https://seeklogo.com/images/F/Fullmetall_Alchemist_anime-logo-59840B9E1F-seeklogo.com.png" alt="Big logo">
            <div class="nav-center">
                <!-- menu -->
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/">Shop<i class="fas fa-angle-down"></i></a></li>
                    <li><a href="/">About</a></li>
                    <li><a href="/admin">Admin</a></li>                            
                </ul>
                <!-- /menu -->
            </div>

            <div class="nav-right">                
                <!-- search button -->
                <a href="/"><i class="fas fa-search"></i></a>
                <!-- /search button -->

                <!-- account -->
                <a href="/"><i class="fas fa-user-circle"></i></a>
                <!-- /account -->

                <!-- cart -->
                <a href="/"><i class="fas fa-shopping-cart"></i></a>
                <!-- /cart -->

                <!-- language -->
                <a href="/">
                    <img src="https://upload.wikimedia.org/wikipedia/en/0/03/Flag_of_Italy.svg" alt="flag italy">
                </a>
                <!-- /language -->
            </div>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'TheHeader'
}
</script>

<style lang="scss">

    @import '../../sass/front/_variables.scss';
    @import '../../sass/front/_colors.scss';

    .header {
        width: 60%;
        margin: 0 auto;
        padding: 15px;
        height: $headerHeight;
        text-align: center;
        background-color: $gray-700;  
        color: $white;
        border-radius: 0 0 30px 30px;
        box-shadow: 0px 8px 8px rgba(0, 0 , 0, 0.3);

        a {
            text-decoration: none;
            color: $white;
            transition: .2s;

            &:hover {
                color: $red;
            }
        }


        .navbar {
            display: flex;
            justify-content: space-between;  
            align-items: center;
            width: 100%;            
            font-size: 1.3em;

            .logo {
                height: 50px;
            }

            .nav-center {
                display: flex;
                justify-content: space-between;
                align-items: center;

                ul {    
                    display: flex;
                    justify-content: space-between;

                    li {
                        display: inline-block;
                        padding: 0 20px;

                        i {    
                            margin-left: 5px;
                        }

                    }
                }
            }

            .nav-right {
                display: flex;

                a {
                    display: flex;
                    align-items: center;
                    padding: 0 10px;

                    img {    
                        height: 20px;
                    }
                }
            }            
        }
    }

</style>