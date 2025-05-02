// src/navigation/Navbar.jsx
import React, { useContext } from 'react';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { createNativeStackNavigator }  from '@react-navigation/native-stack';
import { AuthContext } from '../Context/authContext';  // <-- ruta corregida

import Login      from '../screens/login';
import RegistroScreen   from '../screens/registro';
import Layout           from '../screens/layout';
import JornadasScreen   from '../screens/Jornadas';
import Dashboard        from '../screens/Dashboard';

const Tab   = createBottomTabNavigator();
const Stack = createNativeStackNavigator();

function MainTabs() {
  const { isAuthenticated } = useContext(AuthContext);

  return (
    <Tab.Navigator screenOptions={{ headerShown: false }}>
      {isAuthenticated ? (
        <>
          <Tab.Screen name="Jornadas"  component={JornadasScreen} />
          <Tab.Screen name="Dashboard" component={Dashboard} />
        </>
      ) : (
        <>
          <Tab.Screen name="Layout"   component={Layout} />
          <Tab.Screen name="Login"    component={Login} />
          <Tab.Screen name="Registro" component={RegistroScreen} />
        </>
      )}
    </Tab.Navigator>
  );
}

export default function Navbar() {
  return (
    <Stack.Navigator screenOptions={{ headerShown: false }}>
      <Stack.Screen name="MainTabs" component={MainTabs}/>
    </Stack.Navigator>
  );
}
